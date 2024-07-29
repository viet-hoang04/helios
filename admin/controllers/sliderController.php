<?php
extract($_REQUEST);
require_once './models/sliderModel.php';
require_once './models/categoryModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/slider/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $slider_list = slider_all('index');
            $category_list = category_all('index');
            if (isset($_POST['THEM'])) {
                if (!empty($_FILES['img']['name'])) {
                    // Kiểm tra nếu file không rỗng
                    $file_name = $_FILES['img']['name'];
                    $file_tmp_name = $_FILES['img']['tmp_name'];
                    $upload_path = '../public/images/slider/' . $file_name;
                    if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                        // Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=slider&act=insert');
                    }
                    $img = $file_name;
                }
                slider_insert($name, $link, $position, $info1, $info2, $info3, $img, ($orders + 1), $status);
                set_flash('message', ['type' => 'success', 'msg' => 'Tạo slider mới thành công!']);
                redirect('index.php?option=slider');
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = slider_rowid($id);
            $list_slider = slider_all('index');
            if (isset($_POST['CAPNHAT'])) {
                if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                    //Kiểm tra nếu có tồN tại hình cũ thì xoá hình cũ trong folder đi
                    if (file_exists('../public/images/slider/' . $row['img'])) {
                        unlink('../public/images/slider/' . $row['img']);
                    }
                    // Kiểm tra nếu file không rỗng thf cập nhật hình ảnh mới
                    $file_name = $_FILES['img']['name'];
                    $file_tmp_name = $_FILES['img']['tmp_name'];
                    $upload_path = '../public/images/slider/' . $file_name;
                    if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                        //Lỗi trong quá trình xử lý upload
                        set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                        redirect('index.php?option=slider&act=update&id=' . $id);
                    }
                    $img = $file_name;
                } else {
                    $img = $row['img'];
                }
                slider_update($name, $link, $position, $info1, $info2, $info3, $img, ($orders + 1), $status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'SỬa thông tin slider thành công!']);
                redirect('index.php?option=slider&act=update&id=' . $id);
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = slider_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'slider này không tồn tại!']);
                redirect('index.php?option=slider');
            } else {
                $status = 0;
                slider_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển slider vào kho lưu trữ thành công']);
                redirect('index.php?option=slider');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = slider_rowid($id);  //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'slider này không tồn tại!']);
                redirect('index.php?option=slider&act=trash');
            } else {
                $status = 2;
                slider_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển slider vào kho lưu trữ thành công']);
                redirect('index.php?option=slider&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = slider_rowid($id);
            $status = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'slider này không tồn tại!']);
                redirect('index.php?option=slider');
            } else {
                slider_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái slider thành công']);
                redirect('index.php?option=slider');
            }
            break;
        case 'trash':
            $slider_list = slider_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            $id = $_REQUEST['id'];
            $row = slider_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'error', 'msg' => 'Slider này không tồn tại!']);
                redirect('index.php?option=slider&act=trash');
            } else {
                if (file_exists('../public/images/slider/' . $row['img'])) {
                    unlink('../public/images/slider/' . $row['img']);
                }
                slider_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá Slider thành công']);
                redirect('index.php?option=slider&act=trash');
            }
            break;
        default:
            $slider_list = slider_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $slider_list = slider_all('index');
    require_once $path . 'index.php';
}
