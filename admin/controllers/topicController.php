<?php
extract($_REQUEST);
require_once './models/topicModel.php';
require_once './models/postModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/topic/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            $list_topic = topic_all('index');
            if (isset($_POST['THEM'])) {
                $slug = str_slug($_POST['name']);
                //Kiểm tra xem đã tồn tại slug chưa
                if (topic_slug_exists($slug) == FALSE) {
                    //FALSE = không tồn tại slug đó
                    //Tiến hành lấy dữ liệu và thêm
                    topic_insert($name, $slug, $parent_id, ($_POST['orders'] + 1), $status);
                    set_flash('message', ['type' => 'success', 'msg' => 'Tạo Chủ đề mới thành công!']);
                    redirect('index.php?option=topic');
                } else {
                    //Ngược lại là đã tồn  tại slug rồi, nên không thể thêm
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên Chủ đề đã tồn tại!']);
                    redirect('index.php?option=topic&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            //Lấy ra toàn bộ Chủ đề nhưng loại trừ id của Chủ đề hiện tại đang sửa
            //Sử dụng cho parent_id và orders
            $list_topic = topic_all('index');
            //Lấy ra Chủ đề hiện tại để lấy dữ liệu và sửa
            $row = topic_rowid($id);
            if (isset($_POST['CAPNHAT'])) {
                $slug = str_slug($_POST['name']);
                //Kiểm tra đã tồn tại slug chưa      
                if (topic_slug_exists($slug, $id) == FALSE) {
                    //FALSE = không tồn tại slug đó
                    //Tiến hành lấy dữ liệu và sửa
                    //Kiểm tra Chủ đề có tồn tại Chủ đề con hay không
                    if (!topic_has_children($id)) {
                        //Không tồn tại Chủ đề con
                        topic_update($name, $slug, $parent_id, $orders + 1, $status, $id);
                        set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin Chủ đề thành công!']);
                        redirect('index.php?option=topic&act=update&id=' . $id);
                    } else {
                        //Có tồn tại Chủ đề con thì không cho sửa trạng thái Chủ đề
                        set_flash('message', ['type' => 'warning', 'msg' => 'Chủ đề này có chủ đề con đang hoạt động, không thể chuyển trạng thái!']);
                        redirect('index.php?option=topic&act=update&id=' . $id);
                    }
                } else {
                    //Ngược lại là đã tồn  tại slug rồi, nên không thể thêm
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tên Chủ đề đã tồn tại!']);
                    redirect('index.php?option=topic&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = topic_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Chủ đề này không tồn tại!']);
                redirect('index.php?option=topic');
            } else {
                //Các trường hợp còn lại
                //Trường hợp Chủ đề này có tồn tại Chủ đề con và Chủ đề con đó status !=0
                //Nghĩa là Chủ đề con đó đang hoạt động -> không có xoá!
                //Trường hợp Chủ đề con có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = 0;
                topic_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển Chủ đề vào kho lưu trữ thành công']);
                redirect('index.php?option=topic');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = topic_rowid($id);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Chủ đề này không tồn tại!']);
                redirect('index.php?option=topic&act=trash');
            } else {
                $status = 2;
                topic_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục Chủ đề thành công']);
                redirect('index.php?option=topic&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = topic_rowid($id);
            $stat = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Chủ đề này không tồn tại!']);
                redirect('index.php?option=topic');
            } else {
                //Trường hợp Chủ đề này có tồn tại Chủ đề con và Chủ đề con đó status !=0
                //Nghĩa là Chủ đề con đó đang hoạt động -> không có xoá!
                //Trường hợp Chủ đề con có tồn tại sản phẩm và sản phẩm đó đang hoạt động -> không cho xoá
                $status = $stat;
                topic_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái Chủ đề thành công']);
                redirect('index.php?option=topic');
            }
            break;
        case 'trash':
            $list_topic = topic_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            //Xoá nếu Chủ đề đó có sản phẩm thì sản phẩm đó phải chuyển topic_id hiện tại thành uncategorize -> không Chủ đề
            //Có Chủ đề con -> chuyển parent_id = 0
            $id = $_REQUEST['id'];
            $row = topic_rowid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Chủ đề này không tồn tại!']);
                redirect('index.php?option=topic&act=trash');
            } else {
                //Xoá Chủ đề
                topic_delete($id);
                set_flash('message', ['type' => 'success', 'msg' => 'Xoá Chủ đề thành công']);
                redirect('index.php?option=topic&act=trash');
            }
            break;
        default:
            $list_topic = topic_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_topic = topic_all('index');
    require_once $path . 'index.php';
}
