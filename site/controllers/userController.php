<?php
extract($_REQUEST);
require_once './models/customerModel.php';
require_once './models/orderModel.php';
$email_error = $fullname_error = $phone_error = $gender_error = $address_error = $password_error = '';
if (isset($act)) {
    switch ($act) {
        case 'register':
            //Trang đăng ký thành viên
            if (isset($_POST['BTN_REGISTER'])) {
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $gender = isset($_POST['gender']) ? (int)$_POST['gender'] : '';
                $address = isset($_POST['address']) ? $_POST['address'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';

                // Validate email
                if (empty($email)) {
                    $email_error = "Vui lòng nhập địa chỉ email.";
                } elseif (!validateEmail($email)) {
                    $email_error = "Email không hợp lệ hoặc đã tồn tại.";
                }

                // Validate fullname
                if (empty($fullname)) {
                    $fullname_error = "Vui lòng nhập họ và tên.";
                }

                // Validate phone
                if (empty($phone)) {
                    $phone_error = "Vui lòng nhập số điện thoại.";
                }

                // Validate gender 
                if (empty($gender) && $gender !== 0) {
                    $gender_error = "Vui lòng chọn giới tính.";
                }

                // Validate password
                $password_errors = validatePassword($password, $repassword);
                if (!empty($password_errors)) {
                    $password_error = implode("<br>", $password_errors);
                }
                // If there are no validation errors
                if (empty($email_error) && empty($fullname_error) && empty($phone_error) && empty($gender_error) && empty($address_error) && empty($password_error)) {
                    //Gọi hàm customer_insert
                    $img = 'avatar.png';
                    $role = 'customer';
                    $rank_id = 1;
                    $status = 1;
                    customer_insert($fullname, $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status);
                    set_flash('message', ['type' => 'success', 'msg' => 'Chúc mừng bạn đã tạo tài khoản thành công!']);
                    header('Location: index.php?option=user&act=register');
                    exit();
                }
            }
            require_once 'views/register.php';
            break;
        case 'login':
            // Nếu có session user, chuyển hướng về trang chủ
            if (isset($_SESSION['user'])) {
                header("Location: index.php");
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';
                $email_error = $password_error = '';

                // If there are no validation errors
                if (empty($email_error) && empty($password_error)) {
                    // Kiểm tra email tồn tại
                    if (auth_check($email) == FALSE) {
                        $email_error = "Email không tồn tại";
                    } else {
                        $user = auth_guard($email, $password);
                        if ($user !== FALSE) {
                            $_SESSION['user'] = $user;

                            // Kiểm tra và chuyển hướng về trang trước đó nếu có
                            if (isset($_SESSION['redirect_url'])) {
                                $redirect_url = $_SESSION['redirect_url'];
                                unset($_SESSION['redirect_url']);
                                header("Location: $redirect_url");
                                exit();
                            } else {
                                header("Location: index.php");
                                exit();
                            }
                        } else {
                            $password_error = "Mật khẩu không chính xác";
                        }
                    }
                }
            }

            // Trang đăng nhập
            require_once 'views/login.php';
            break;
        case 'forgot':
            //Trang quên mật khẩu
            require_once 'views/forgot-password.php';
            break;
        case 'account-detail':
            //Trang thông tin tai khoản
            if (isset($_POST['BTN_UPDATE'])) {
                $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['user']['email'];
                $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : $_SESSION['user']['fullname'];
                $phone = isset($_POST['phone']) ? $_POST['phone'] : $_SESSION['user']['phone'];
                $gender = isset($_POST['gender']) ? (int)$_POST['gender'] : $_SESSION['user']['gender'];
                $address = isset($_POST['address']) ? $_POST['address'] : $_SESSION['user']['address'];
                $password = $_SESSION['user']['password'];
                if (isset($_POST['change_password'])) {
                    $cpassword = $_POST['cpassword'];
                    $npassword = $_POST['npassword'];
                    $cnewpassword = $_POST['cnewpassword'];

                    $img = handleImageUpload();

                    if ($npassword == $cnewpassword && $cnewpassword != $cpassword) {
                        validateAndUpdate($fullname, $cnewpassword, $email, $address, $gender, $phone, $img);
                    } else {
                        $password_error = "Mật khẩu mới không khớp hoặc giống mật khẩu cũ.";
                    }
                } else {
                    $img = handleImageUpload();
                    validateAndUpdate($fullname, $_SESSION['user']['password'], $email, $address, $gender, $phone, $img);
                }
            }
            require_once 'views/account-detail.php';
            break;
        case 'account':
            //Trang tài khoản
            $rank_id = $_SESSION['user']['id'];
            $rank = get_rank_user($rank_id);
            $rank_img = get_rank_img($rank['id']);
            require_once 'views/account.php';
            break;
        case 'history-orders':
            $list_order = list_order_by_userid($_SESSION['user']['id']);
            foreach ($list_order as &$order) {
                $order['order_details'] = get_order_details_by_order_id($order['id']);
            }
            require_once 'views/account-orders.php';
            break;
        case 'view-order':
            $list_orderdetail = get_order_details_by_order_id($_REQUEST['id']);
            require_once 'views/view-order.php';
            break;
        case 'cancel-order':
            $order_id = $_REQUEST['id'];
            $result = cancel_order($order_id);
            if ($result) {
                $thongbao = "Huỷ đơn hàng thành công!";
                set_flash('message', ['type' => 'success', 'msg' => 'Huỷ đơn hàng thành công!']);
                header('Location: index.php?option=user&act=history-orders');
                exit();
            }
            break;
        case 'logout':
            //Trang đăng xuất
            session_unset();
            header("Location: index.php?option=page&act=home");
            break;
    }
} else {
    require_once 'views/account.php';
}
