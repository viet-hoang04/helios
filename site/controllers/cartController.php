<?php
extract($_REQUEST);
require_once './models/brandModel.php';
require_once './models/categoryModel.php';
require_once './models/productModel.php';
require_once './models/contactModel.php';
require_once './models/blogModel.php';
require_once './models/customerModel.php';
require_once './models/slider_banner_Model.php';
require_once './models/configModel.php';
if (isset($act)) {
    switch ($act) {
        case 'add-cart':
            $act = $_REQUEST['act'];
            $id = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : null;
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php'; // Nếu không có trang trước đó, quay lại trang chủ
            if (!isset($_SESSION['user'])) {
                // Nếu không có session user, chuyển hướng đến trang đăng nhập và lưu lại trang trước đó
                $_SESSION['redirect_url'] = $referer;
                header("Location: index.php?option=user&act=login");
                exit();
            }
            if (isset($act) && $act == 'add-cart') {
                $sp = product_rowid($id);
                $list_size = product_by_size($sp['id']);
                $material_name = get_material_name($sp['material_id']);
                $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;
                $selected_size = isset($_POST['selected_size']) ? $_POST['selected_size'] : $list_size[0]['name_size'];
                // Tính toán giá dựa trên điều kiện promotion
                $calculated_price = isset($_POST['calculated_price']) ? $_POST['calculated_price'] : $list_size[0]['temp_price'] - ($list_size[0]['temp_price'] * $sp['promotion'] / 100);
                // Kiểm tra URL hiện tại để xác định cách xử lý
                // Nếu thêm từ trang product-detail, sử dụng giá trị từ form
                if (strpos($_SERVER['REQUEST_URI'], 'act=product-detail') != TRUE) {
                    $data = array(
                        'id' => $sp['id'],
                        'name' => $sp['name'],
                        'slug' => $sp['slug'],
                        'img' => $sp['more_images'][0],
                        'material' => $material_name,
                        'size' => $selected_size,
                        'price' => $calculated_price,
                        'qty' => $qty
                    );
                } else {
                    //Trường hợp không phải trang product-detail
                    $data = array(
                        'id' => $sp['id'],
                        'name' => $sp['name'],
                        'slug' => $sp['slug'],
                        'img' => $sp['more_images'][0],
                        'material' => $list_material,
                        'size' => $selected_size,
                        'price' => $calculated_price,
                        'qty' => 1
                    );
                }
                // echo "<pre>";
                // var_dump($data);
                cart_insert($data);
                header("Location: $referer");
                exit();
            }
            break;
        case 'cart-update':
            $current_url = $_SERVER['REQUEST_URI'];
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
            $list_pid = $_POST['pid'];
            $list_qty = $_POST['qty'];
            $data = array();
            foreach ($list_pid as $key => $id) {
                $row = array(
                    'id' => $id,
                    'qty' => $list_qty[$key]
                );
                $data[] = $row;
            }
            cart_update($data);
            header("Location: $referer");
            exit();
        case 'cart-delete':
            $current_url = $_SERVER['REQUEST_URI'];
            $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php'; // Nếu không có trang trước đó, quay lại trang chủ
            if (!isset($_REQUEST['pid'])) {
                cart_delete();
            } else {
                cart_delete($_REQUEST['pid']);
            }
            header("Location: $referer");
            exit();
        case 'cart-view':
            $list = cart_content();
            require_once 'views/cart.php';
            break;
        case 'cart-checkout':
            if (!isset($_SESSION['user']) || (!isset($_SESSION['cart']) || empty($_SESSION['cart']))) {
                header('location: index.php?option=page&act=home');
                exit();
            }
            $list = cart_content();
            $user_id = $_SESSION['user']['id'];
            $rank = get_rank_user($user_id);
            $rank_img = get_rank_img($rank['id']);
            require_once 'views/checkout.php';
            break;
        case 'insert-order':
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $list = cart_content();

                // Kiểm tra checkbox "Địa chỉ Khác"
                if (isset($_POST['new_info'])) {
                    // Lấy thông tin địa chỉ mới từ biểu mẫu
                    $user_id = $_SESSION['user']['id'];
                    $delivery_fullname = $_POST['other_fullname'];
                    $delivery_email = $_POST['other_email'];
                    $delivery_phone = $_POST['other_phone'];
                    $delivery_address = $_POST['other_address'];
                    $note = $_POST['order_notes'];
                    $total_price = $_POST['total'];
                    $created_at = date('Y-m-d H:i:s');
                    $exported_at = date('Y-m-d H:i:s');

                    // Kiểm tra và bắt lỗi nếu các trường bắt buộc không được điền
                    $email_error = empty($delivery_email) ? 'Vui lòng nhập địa chỉ email hợp lệ.' : '';
                    $fullname_error = empty($delivery_fullname) ? 'Vui lòng nhập họ tên.' : '';
                    $phone_error = empty($delivery_phone) ? 'Vui lòng nhập số điện thoại.' : '';
                    $address_error = empty($delivery_address) ? 'Vui lòng nhập địa chỉ mới.' : '';

                    if (empty($email_error) && empty($fullname_error) && empty($phone_error) && empty($address_error)) {
                        // Gọi hàm insert_order với thông tin địa chỉ mới
                        cart_insert_orders($user_id, $delivery_fullname, $delivery_address, $delivery_phone, $delivery_email, $created_at, $exported_at, $total_price, $payment_method, $note, $list);


                        // Đặt flash message và chuyển hướng về trang chủ
                        set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Đặt hàng thành công!']);
                        unset($_SESSION['cart']);
                        header('location: ?option=cart&act=cart-checkout');
                        exit();
                    } else {
                        // Gán giá trị lỗi vào biến để hiển thị trong form
                        set_flash('errors', [
                            'email' => $email_error,
                            'fullname' => $fullname_error,
                            'phone' => $phone_error,
                            'address' => $address_error
                        ]);
                        header('location: index.php?option=cart&act=cart-checkout');
                        exit();
                    }
                } else {
                    // Trường hợp không chọn địa chỉ khác
                    $user_id = $_SESSION['user']['id'];
                    $delivery_fullname = $_SESSION['user']['fullname'];
                    $delivery_email = $_SESSION['user']['email'];
                    $delivery_phone = $_SESSION['user']['phone'];
                    $delivery_address = $_SESSION['user']['address'];

                    if (isset($_POST['payment_method'])) {
                        $payment_method = $_POST['payment_method'];
                    } else {
                        // Xử lý khi không có phương thức thanh toán được chọn
                        $payment_method = 0; // Thay thế bằng giá trị mặc định hoặc xử lý khác tùy vào yêu cầu của bạn
                    }
                    $total_price = $_POST['total'];
                    $note = $_POST['order_notes'];
                    $created_at = date('Y-m-d H:i:s');
                    $exported_at = date('Y-m-d H:i:s');

                    // Gọi hàm insert_order với thông tin địa chỉ từ session
                    cart_insert_orders($user_id, $delivery_fullname, $delivery_address, $delivery_phone, $delivery_email, $created_at, $exported_at, $total_price, $payment_method, $note, $list);

                    // Đặt flash message và chuyển hướng về trang chủ
                    set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Đặt hàng thành công!']);
                    unset($_SESSION['cart']);
                    header('location: ?option=cart&act=cart-checkout');
                    exit();
                }
            }
            break;
    }
} else {
    $list = cart_content();
    require_once 'views/cart.php';
}
