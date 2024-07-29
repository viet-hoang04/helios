<?php
extract($_REQUEST);
require_once './models/configModel.php';
$path = 'views/pages/config/';
if (isset($act)) {
    switch ($act) {
        case 'update':
            $id = $_REQUEST['id'];
            $row = config_rowid($id);
            if (isset($_POST['CAPNHAT'])) {
                if (isset($_FILES['logo']) && !empty($_FILES['logo']['name'])) {
                    // Kiểm tra nếu có tồn tại hình cũ thì xoá hình cũ trong folder đi
                    if (file_exists('../public/images/' . $row['logo'])) {
                        unlink('../public/images/' . $row['logo']);
                    }
                    // Kiểm tra nếu file không rỗng thì cập nhật hình ảnh mới
                    $file_logo_name = $_FILES['logo']['name'];
                    $file_logo_tmp_name = $_FILES['logo']['tmp_name'];
                    $upload_path = '../public/images/' . $file_logo_name;
                    if (!move_uploaded_file($file_logo_tmp_name, $upload_path)) {
                        // Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=config');
                    }
                    $logo = $file_logo_name;
                } else {
                    $logo = $row['logo'];
                }

                if (isset($_FILES['icon']) && !empty($_FILES['icon']['name'])) {
                    //Kiểm tra nếu có tồn tại hình cũ thì xoá hình cũ trong folder đi
                    if (file_exists('../public/images/' . $row['icon'])) {
                        unlink('../public/images/' . $row['icon']);
                    }
                    // Kiểm tra nếu file không rỗng thf cập nhật hình ảnh mới
                    $file_icon_name = $_FILES['icon']['name'];
                    $file_icon_tmp_name = $_FILES['icon']['tmp_name'];
                    $upload_path = '../public/images/' . $file_icon_name;
                    if (!move_uploaded_file($file_icon_tmp_name, $upload_path)) {
                        //Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=config');
                    }
                    $icon = $file_icon_name;
                } else {
                    $icon = $row['icon'];
                }
                config_update($title, $logo, $icon, $url, $address, $map, $phone, $email, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Chỉnh sửa cấu hình website thành công!']);
                redirect('index.php?option=config');
            }
            break;
        default:
            $row = config_all();
            require_once $path . 'index.php';
            break;
    }
} else {
    $row = config_all();
    require_once $path . 'index.php';
}
