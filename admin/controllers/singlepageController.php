<?php
extract($_REQUEST);
require_once './models/topicModel.php';
require_once './models/singlepageModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/single_page/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $list_topic = topic_all('index');
            if (isset($_POST['THEM'])) {
                $slug = str_slug($title);
                if (singlepage_slug_exists($slug) == FALSE) {
                    $type = 'singlepage';
                    if (!empty($_FILES['img']['name'])) {
                        // Kiểm tra nếu file không rỗng
                        $file_name = $_FILES['img']['name'];
                        $file_tmp_name = $_FILES['img']['tmp_name'];
                        $name_img = $slug . '.' . get_duoi_file($file_name);
                        $upload_path = '../public/images/post/' . $name_img;
                        if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                            // Lỗi trong quá trình xử lý upload
                            set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                            redirect('index.php?option=single_page&act=insert');
                        }
                        $img = $name_img;
                    }
                    singlepage_insert($topic_id, $title, $slug, $detail, $img, $type, $status);
                    set_flash('message', ['type' => 'success', 'msg' => 'Thêm bài viết mới thành công!']);
                    redirect('index.php?option=single_page');
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên bài viết đã tồn tại!']);
                    redirect('index.php?option=single_page&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = singlepage_rowid($id);
            $list_topic = topic_all('index');
            if (isset($_POST['CAPNHAT'])) {
                $slug = str_slug($_POST['title']);
                if (singlepage_slug_exists($slug, $id) == FALSE) {
                    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                        //Kiểm tra nếu có tồn tại hình cũ thì xoá hình cũ trong folder đi
                        if (file_exists('../public/images/post/' . $row['img'])) {
                            unlink('../public/images/post/' . $row['img']);
                        }
                        // Kiểm tra nếu file không rỗng thf cập nhật hình ảnh mới
                        $file_name = $_FILES['img']['name'];
                        $file_tmp_name = $_FILES['img']['tmp_name'];
                        $name_img = $slug . '.' . get_duoi_file($file_name);
                        $upload_path = '../public/images/post/' . $name_img;
                        if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                            //Lỗi trong quá trình xử lý upload
                            set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                            redirect('index.php?option=single_page&act=update&id=' . $id);
                        }
                        $img = $name_img;
                    } else {
                        $img = $row['img'];
                    }
                    singlepage_update($title, $slug, $detail, $img, $status, $id);
                    set_flash('message', ['type' => 'success', 'msg' => 'Chỉnh sửa nội dung bài viết thành công!']);
                    redirect('index.php?option=single_page');
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên bài viết đã tồn tại!']);
                    redirect('index.php?option=single_page&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = singlepage_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Bài viết này không tồn tại!']);
                redirect('index.php?option=single_page');
            } else {
                $status = 0;
                singlepage_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển Bài viết vào kho lưu trữ thành công']);
                redirect('index.php?option=single_page');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = singlepage_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Bài viết này không tồn tại!']);
                redirect('index.php?option=single_page&act=trash');
            } else {
                $status = 2;
                singlepage_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục bài viết thành công']);
                redirect('index.php?option=single_page&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = singlepage_rowid($id);
            $stat = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Bài viết này không tồn tại!']);
                redirect('index.php?option=single_page');
            } else {
                //Trường hợp Bài viết có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = $stat;
                singlepage_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái Bài viết thành công']);
                redirect('index.php?option=single_page');
            }
            break;
        case 'trash':
            $list_singlepage = singlepage_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            $id = $_REQUEST['id'];
            $row = singlepage_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'error', 'msg' => 'Bài viết này không tồn tại!']);
                redirect('index.php?option=single_page&act=trash');
            } else {
                //Xoá Bài viết
                singlepage_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá Bài viết thành công']);
                redirect('index.php?option=single_page&act=trash');
            }
            break;
        default:
            $list_singlepage = singlepage_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_singlepage = singlepage_all('index');
    require_once $path . 'index.php';
}
