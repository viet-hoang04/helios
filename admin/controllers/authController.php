<?php
extract($_REQUEST);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['LOGIN'])) {
    // Lấy thông tin đăng nhập từ form
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (auth_check($email) == FALSE) {
        $error_email = "Tên đăng nhập không tồn tại";
    } else {
        $user = auth_guard($email, $password);
        if ($user != FALSE) {
            session_start();
            $_SESSION['user'] = $user;
            if ($_SESSION['user']['role'] == 'customer') {
                $error_email = 'Bạn không có quyền truy cập';
            } else {
                header('Location: index.php?option=dashboard');
            }
        } else {
            $error_password = "Mật khẩu không chính xác";
        }
    }
}

// Nếu không phải là submit form đăng nhập, có thể hiển thị form đăng nhập
require_once './login.php';
