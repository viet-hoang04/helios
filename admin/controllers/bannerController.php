<?php
extract($_REQUEST);
require_once './models/bannerModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/banner/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $banner_list = banner_all('index');
            if (isset($_POST['THEM'])) {
                if (!empty($_FILES['img']['name'])) {
                    // Kiểm tra nếu file không rỗng
                    $file_name = $_FILES['img']['name'];
                    $file_tmp_name = $_FILES['img']['tmp_name'];
                    $upload_path = '../public/images/banner/' . $file_name;
                    if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                        // Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=banner&act=insert');
                    }
                    $img = $file_name;
                }
                banner_insert($name, $link, $position, $info1, $info2, $info3, $img, ($orders + 1), $status);
                set_flash('message', ['type' => 'success', 'msg' => 'Tạo banner mới thành công!']);
                redirect('index.php?option=banner');
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = banner_rowid($id);
            $list_banner = banner_all('index');
            if (isset($_POST['CAPNHAT'])) {
                if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                    //Kiểm tra nếu có tồN tại hình cũ thì xoá hình cũ trong folder đi
                    if (file_exists('../public/images/banner/' . $row['img'])) {
                        unlink('../public/images/banner/' . $row['img']);
                    }
                    // Kiểm tra nếu file không rỗng thf cập nhật hình ảnh mới
                    $file_name = $_FILES['img']['name'];
                    $file_tmp_name = $_FILES['img']['tmp_name'];
                    $upload_path = '../public/images/banner/' . $file_name;
                    if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                        //Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=banner&act=insert');
                    }
                    $img = $file_name;
                } else {
                    $img = $row['img'];
                }
                banner_update($name, $link, $position, $info1, $info2, $info3, $img, ($orders + 1), $status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'SỬa thông tin banner mới thành công!']);
                redirect('index.php?option=banner');
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = banner_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Banner này không tồn tại!']);
                redirect('index.php?option=banner');
            } else {
                $status = 0;
                banner_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển banner vào kho lưu trữ thành công']);
                redirect('index.php?option=banner');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = banner_rowid($id);  //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'banner này không tồn tại!']);
                redirect('index.php?option=banner&act=trash');
            } else {
                $status = 2;
                banner_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển banner vào kho lưu trữ thành công']);
                redirect('index.php?option=banner&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = banner_rowid($id);
            $status = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'banner này không tồn tại!']);
                redirect('index.php?option=banner');
            } else {
                banner_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái banner thành công']);
                redirect('index.php?option=banner');
            }
            break;
        case 'trash':
            $banner_list = banner_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            $id = $_REQUEST['id'];
            $row = brand_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'error', 'msg' => 'Thương hiệu này không tồn tại!']);
                redirect('index.php?option=brand&act=trash');
            } else {
                if (file_exists('../public/images/banner/' . $row['img'])) {
                    unlink('../public/images/banner/' . $row['img']);
                }
                brand_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá thương hiệu thành công']);
                redirect('index.php?option=brand&act=trash');
            }
            break;
        default:
            $banner_list = banner_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $banner_list = banner_all('index');
    require_once $path . 'index.php';
}
