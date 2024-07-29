<?php
extract($_REQUEST);
require_once './models/contactModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/contact/';
if (isset($act)) {
    switch ($act) {
        case 'update':
            $id = $_REQUEST['id'];
            $row = contact_rowid($id);
            if (isset($_POST['TRALOILIENHE'])) {
                $contact_return = $_POST['contact_return'];
                $status = 1;
                $result = contact_update($contact_return, $status, $id);
                if ($result) {
                    set_flash('message', ['type' => 'success', 'msg' => 'Trả lời liên hệ thành công!']);
                    redirect('index.php?option=contact');
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Trả lời liên hệ thất bại!']);
                    redirect('index.php?option=contact');
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = contact_rowid($id); //$row có thể hiểu là lấy 1 dòng dữ liệu dựa theo id, id = request từ url
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'success', 'msg' => 'Liên hệ này không tồn tại!']);
                redirect('index.php?option=contact');
            } else {
                //Thay đổi giá trị cho cột điều kiện xoá
                //Giá trị isDelete = 1 => Chưa di chuyển vào kho lưu trữ
                //Giá trị isDelete = 0 => Đã di chuyển vào kho lưu trữ
                $isdelete = 0;
                contact_deltrash($isDeleted, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển liên hệ vào kho lưu trữ thành công']);
                redirect('index.php?option=contact');
            }
            break;
        case 'trash':
            $list_contact = contact_list('trash');
            require_once $path . 'trash.php';
            break;
            // case 'delete':
            //     break;
        default:
            $list_contact = contact_list('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_contact = contact_list('index');
    require_once $path . 'index.php';
}
