<?php
extract($_REQUEST);
require_once './models/brandModel.php';
require_once './models/productModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/brand/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $list_brand = brand_all('index');
            if (isset($_POST['THEM'])) {
                $slug = str_slug($_POST['name']);
                if (brand_slug_exists($slug) == FALSE) {
                    //Kiểm tra trả về FALSE tức là không có slug trùng
                    //Tiến hành lấy dữ liệu và thực hiện thêm vào database
                    //Thực hiện xử lý hình ảnh:
                    // Xử lý hình ảnh
                    if (!empty($_FILES['img']['name'])) {
                        // Kiểm tra nếu file không rỗng
                        $file_name = $_FILES['img']['name'];
                        $file_tmp_name = $_FILES['img']['tmp_name'];
                        $name_img = $slug . '.' . get_duoi_file($file_name); // Đổi tên file theo tên slug lấy được
                        $upload_path = '../public/images/brand/' . $name_img;
                        if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                            // Lỗi trong quá trình xử lý upload
                            set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                            redirect('index.php?option=brand&act=insert');
                        }
                        $img = $name_img;
                    }
                    brand_insert($name, $slug, $img, ($_POST['orders'] + 1), $status);
                    set_flash('message', ['type' => 'success', 'msg' => 'Thêm thương hiệu mới thành công!']);
                    redirect('index.php?option=brand');
                } else {
                    //Ngược lại là đã tồn  tại slug rồi, nên không thể thêm
                    set_flash('message', ['type' => 'warning', 'msg' => 'Thương hiệu này đã tồn tại!']);
                    redirect('index.php?option=brand&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = brand_rowid($id);
            $list_brand = brand_all('index');
            if (isset($_POST['CAPNHAT'])) {
                $slug = str_slug($_POST['name']);
                if (brand_slug_exists($slug, $id) == FALSE) {
                    //Không tồn tại slug mới
                    //lấy thông tin và xử lý hình ảnh
                    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                        //Kiểm tra nếu có tồN tại hình cũ thì xoá hình cũ trong folder đi
                        if (file_exists('../public/images/brand/' . $row['img'])) {
                            unlink('../public/images/brand/' . $row['img']);
                        }
                        // Kiểm tra nếu file không rỗng thf cập nhật hình ảnh mới
                        $file_name = $_FILES['img']['name'];
                        $file_tmp_name = $_FILES['img']['tmp_name'];
                        $name_img = $slug . '.' . get_duoi_file($file_name);
                        $upload_path = '../public/images/brand/' . $name_img;
                        if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                            //Lỗi trong quá trình xử lý upload
                            set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                            redirect('index.php?option=brand&cat=insert');
                        }
                        $img = $name_img;
                    } else {
                        $img = $row['img'];
                    }
                    brand_update($name, $slug, $img, ($order + 1), $status, $id);
                    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin thương hiệu thành công!']);
                    redirect('index.php?option=brand&act=update&id=' . $id);
                } else {
                    //Ngược lại, tránh khi đổi tên thương hiệu lại trùng với dữ liệu đã có từ trước
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên thương hiệu này đã tồn tại!']);
                    redirect('index.php?option=brand&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = brand_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Thương hiệu này không tồn tại!']);
                redirect('index.php?option=brand');
            } else {
                //Các trường hợp còn lại
                //Trường hợp thương hiệu con có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = 0;
                brand_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển thương hiệu vào kho lưu trữ thành công']);
                redirect('index.php?option=brand');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = brand_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Thương hiệu này không tồn tại!']);
                redirect('index.php?option=brand&act=trash');
            } else {
                $status = 2;
                brand_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục thương hiệu thành công']);
                redirect('index.php?option=brand&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = brand_rowid($id);
            $stat = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Thương hiệu này không tồn tại!']);
                redirect('index.php?option=brand');
            } else {
                //Trường hợp thương hiệu có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = $stat;
                brand_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái thương hiệu thành công']);
                redirect('index.php?option=brand');
            }
            break;
        case 'trash':
            $brand_list = brand_all('trash');
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
                //Xoá thương hiệu
                brand_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá thương hiệu thành công']);
                redirect('index.php?option=brand&act=trash');
            }
            break;
        default:
            $brand_list = brand_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $brand_list = brand_all('index');
    require_once $path . 'index.php';
}
