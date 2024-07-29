<?php
extract($_REQUEST);
require_once './models/customerModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/customer/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            if (isset($_POST['THEM'])) {
                if (customer_exists($email) == FALSE) {
                    if ($repassword == $password) {
                        $role = 'customer';
                        $rank_id = 1;
                        // Xử lý hình ảnh
                        if (!empty($_FILES['img']['name'])) {
                            // Kiểm tra nếu file không rỗng
                            $file_name = $_FILES['img']['name'];
                            $file_tmp_name = $_FILES['img']['tmp_name'];
                            $upload_path = '../public/images/user/' . $file_name;
                            if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                                // Lỗi trong quá trình xử lý upload
                                set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                                redirect('index.php?option=customer&act=insert');
                            }
                            $img = $file_name;
                        }
                        customer_insert($fullname, $password, $email, $address, $gender,  $phone, $img, $role, $rank_id, $status);
                        set_flash('message', ['type' => 'success', 'msg' => 'Thêm khách hàng mới thành công!']);
                        redirect('index.php?option=customer');
                    }
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tài khoản đã tồn tại!']);
                    redirect('index.php?option=customer&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = customer_getid($id);
            if (isset($_POST['CAPNHAT'])) {
                if (customer_exists($email, $id) == FALSE) {
                    if ($repassword == $password) {
                        // Xử lý hình ảnh (chỉ khi người dùng thay đổi hình ảnh)
                        if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                            if (file_exists('../public/images/user/' . $row['img'])) {
                                unlink('../public/images/user/' . $row['img']);
                            }
                            // Kiểm tra nếu file không rỗng
                            $file_name = $_FILES['img']['name'];
                            $file_tmp_name = $_FILES['img']['tmp_name'];
                            $upload_path = '../public/images/user/' . $file_name;
                            if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                                //Lỗi trong quá trình xử lý upload
                                set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                                redirect('index.php?option=customer&act=update');
                            }
                            $img = $file_name;
                        } else {
                            $img = $row['img'];
                        }
                        customer_update($fullname, $password, $email, $address, $gender, $phone, $img, $status, $id);
                        set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin khách hàng thành công!']);
                        redirect('index.php?option=customer');
                    } else {
                        set_flash('message', ['type' => 'warning', 'msg' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp!']);
                        redirect('index.php?option=customer&act=update&id=' . $id);
                    }
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tài khoản đã tồn tại!']);
                    redirect('index.php?option=customer&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = customer_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=customer');
            } else {
                $status = 0;
                customer_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Đưa tài khoản vào thùng rác thành công']);
                redirect('index.php?option=customer');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = customer_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=customer&act=trash');
            } else {
                $status = 2;
                customer_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục tài khoản thành công']);
                redirect('index.php?option=customer&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = customer_getid($id);
            $status = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                header('index.php?option=customer');
            } else {
                customer_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái tài khoản thành công']);
                redirect('index.php?option=customer');
            }
            break;
        case 'trash':
            $list_user = customer_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            $id = $_REQUEST['id'];
            $row = customer_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=customer&act=trash');
            } else {

                //Xoá Người dùng
                if (file_exists('../public/images/user/' . $row['img'])) {
                    unlink('../public/images/user/' . $row['img']);
                }
                customer_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá Người dùng thành công']);
                redirect('index.php?option=customer&act=trash');
            }
            break;
        default:
            $list_user = customer_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_user = customer_all('index');
    require_once $path . 'index.php';
}
