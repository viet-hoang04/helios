<?php
extract($_REQUEST);
require_once './models/orderModel.php';
require_once './models/userModel.php';
require_once './models/configModel.php';
$path = 'views/pages/order/';
if (isset($act)) {
    switch ($act) {
        case 'stage':
            $id = $_REQUEST['id'];
            $value = $_REQUEST['value'];
            $row = order_rowid($id);
            $user = user_getid($row['user_id']);
            if ($row == NULL) {
                //Tránh trường hợp người quản trị viết id trực tiếp trên url
                set_flash('message', ['type' => 'warning', 'msg' => 'Đơn hàng này không tồn tại!']);
                redirect('index.php?option=order');
            } else {
                $stage = $value;
                order_update_stage($stage, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái đơn hàng thành công']);
                redirect('index.php?option=order');
            }
            break;
        case 'detail':
            $id = $_REQUEST['id'];
            $row = order_rowid($id);
            $list_orderdetail = get_order_details_by_order_id($row['id']);
            require_once $path . 'order-detail.php';
            break;
        case 'trash':
            $list_order = order_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = order_rowid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Đơn hàng này không tồn tại!']);
                redirect('index.php?option=order');
            } else {
                $status = 2;
                order_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Di chuyển đơn hàng vào lưu trữ thành công!']);
                redirect('index.php?option=order');
            }
        default:
            $list_order = order_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_order = order_all('index');
    require_once $path . 'index.php';
}
