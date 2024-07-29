<?php
extract($_REQUEST);
require_once './models/sizeModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/size/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            if (isset($_POST['THEM'])) {
                $rate = $_POST['rate'] / 100;
                $result = size_insert($name_size, $rate);
                header('Location: index.php?option=size');
                if ($result) {
                    set_flash('message', ['type' => 'success', 'msg' => 'Tạo kích cỡ mới thành công!']);
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tạo kích cỡ mới thất bại!']);
                }
                exit();
            }
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = size_by_id($id);
            if (isset($_POST['CAPNHAT'])) {
                $rate = $_POST['rate'] / 100;
                $result = size_update($name_size, $rate, $id);
                header('Location: index.php?option=size');
                if ($result) {
                    set_flash('message', ['type' => 'success', 'msg' => 'Sửa thông tin kích cỡ thành công!']);
                } else {
                    set_flash('message', ['type' => 'success', 'msg' => 'Sửa thông tin kích cỡ thất bại!']);
                }
                exit();
            }
            break;
        default:
            $list_size = size_all();
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_size = size_all();
    require_once $path . 'index.php';
}
