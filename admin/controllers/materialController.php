<?php
extract($_REQUEST);
require_once './models/materialModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/material/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            if (isset($_POST['THEM'])) {
                $rate = $_POST['rate'] / 100;
                $result = material_insert($name, $rate);
                header('Location: index.php?option=material');
                if ($result) {
                    set_flash('message', ['type' => 'success', 'msg' => 'Tạo chất liệu mới thành công!']);
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tạo chất liệu mới thất bại!']);
                }
                exit();
            }
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = material_by_id($id);
            if (isset($_POST['CAPNHAT'])) {
                $rate = $_POST['rate'] / 100;
                $result = material_update($name, $rate, $id);
                header('Location: index.php?option=material');
                if ($result) {
                    set_flash('message', ['type' => 'success', 'msg' => 'Sửa thông tin chất liệu thành công!']);
                } else {
                    set_flash('message', ['type' => 'success', 'msg' => 'Sửa thông tin chất liệu thất bại!']);
                }
                exit();
            }
            break;
        default:
            $list_material = material_all();
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_material = material_all();
    require_once $path . 'index.php';
}
