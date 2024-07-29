<?php
extract($_REQUEST);
require_once './models/categoryModel.php';
require_once './models/productModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/category/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $list_category = category_all('index');
            if (isset($_POST['THEMDANHMUC'])) {
                $slug = str_slug($_POST['name']);
                //Kiểm tra xem đã tồn tại slug chưa
                if (category_slug_exists($slug) == FALSE) {
                    //FALSE = không tồn tại slug đó
                    //Tiến hành lấy dữ liệu và thêm
                    category_insert($name, $slug, $parent_id, ($_POST['orders'] + 1), $status);
                    set_flash('message', ['type' => 'success', 'msg' => 'Tạo danh mục mới thành công!']);
                    redirect('index.php?option=category');
                } else {
                    //Ngược lại là đã tồn  tại slug rồi, nên không thể thêm
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên danh mục đã tồn tại!']);
                    redirect('index.php?option=category&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            //Lấy ra toàn bộ danh mục nhưng loại trừ id của danh mục hiện tại đang sửa
            //Sử dụng cho parent_id và orders
            $list_category = category_all('index');
            //Lấy ra danh mục hiện tại để lấy dữ liệu và sửa
            $row = category_rowid($id);
            if (isset($_POST['CAPNHATDANHMUC'])) {
                $slug = str_slug($_POST['name']);
                //Kiểm tra đã tồn tại slug chưa      
                if (category_slug_exists($slug, $id) == FALSE) {
                    //FALSE = không tồn tại slug đó
                    //Tiến hành lấy dữ liệu và sửa
                    //Kiểm tra danh mục có tồn tại danh mục con hay không
                    if (!category_has_children($id)) {
                        //Không tồn tại danh mục con
                        category_update($name, $slug, $parent_id, $orders + 1, $status, $id);
                        set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin danh mục thành công!']);
                        redirect('index.php?option=category');
                    } else {
                        //Có tồn tại danh mục con thì không cho sửa trạng thái danh mục
                        set_flash('message', ['type' => 'warning', 'msg' => 'Danh mục này có danh mục con, không thể chuyển trạng thái!']);
                        redirect('index.php?option=category&act=update&id=' . $id);
                    }
                } else {
                    //Ngược lại là đã tồn  tại slug rồi, nên không thể thêm
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên danh mục đã tồn tại!']);
                    redirect('index.php?option=category&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = category_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Danh mục này không tồn tại!']);
                redirect('index.php?option=category');
            } else {
                //Các trường hợp còn lại
                //Trường hợp danh mục này có tồn tại danh mục con và danh mục con đó status !=0
                //Nghĩa là danh mục con đó đang hoạt động -> không có xoá!
                //Trường hợp danh mục con có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = 0;
                category_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển danh mục vào kho lưu trữ thành công']);
                redirect('index.php?option=category');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = category_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Danh mục này không tồn tại!']);
                redirect('index.php?option=category&act=trash');
            } else {
                $status = 2;
                category_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục danh mục thành công']);
                redirect('index.php?option=category&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = category_rowid($id);
            $stat = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Danh mục này không tồn tại!']);
                redirect('index.php?option=category');
            } else {
                //Trường hợp danh mục này có tồn tại danh mục con và danh mục con đó status !=0
                //Nghĩa là danh mục con đó đang hoạt động -> không có xoá!
                //Trường hợp danh mục con có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = $stat;
                category_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái danh mục thành công']);
                redirect('index.php?option=category');
            }
            break;
        case 'trash':
            $list_category = category_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            //Xoá nếu danh mục đó có sản phẩm thì sản phẩm đó phải chuyển category_id hiện tại thành uncategorize -> không danh mục
            //Có danh mục con -> chuyển parent_id = 0
            $id = $_REQUEST['id'];
            $row = category_rowid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Danh mục này không tồn tại!']);
                redirect('index.php?option=category&act=trash');
            } else {
                //Xoá danh mục
                category_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá danh mục thành công']);
                redirect('index.php?option=category&act=trash');
            }
            break;
        default:
            $list_category = category_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_category = category_all('index');
    require_once $path . 'index.php';
}
