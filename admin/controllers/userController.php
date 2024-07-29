<?php
extract($_REQUEST);
require_once './models/userModel.php';
//Lấy đường dẫn mặc định
$path = 'views/pages/user/';
if (isset($act)) {
    switch ($act) {
        case 'insert':
            if (isset($_POST['THEM'])) {
                if (user_exists($email) == FALSE) {
                    if ($repassword == $password) {
                        $rank_id = 4; //Cấp thẻ usercard cao nhất
                        // Xử lý hình ảnh
                        if (!empty($_FILES['img']['name'])) {
                            // Kiểm tra nếu file không rỗng
                            $file_name = $_FILES['img']['name'];
                            $file_tmp_name = $_FILES['img']['tmp_name'];
                            $upload_path = '../public/images/user/' . $file_name;
                            if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                                // Lỗi trong quá trình xử lý upload
                                set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                                redirect('index.php?option=user&act=insert');
                            }
                            $img = $file_name;
                        }
                        user_insert($fullname, $password, $email, $address, $gender,  $phone, $img, $role, $rank_id, $status);
                        set_flash('message', ['type' => 'success', 'msg' => 'Thêm quản trị viên mới thành công!']);
                        redirect('index.php?option=user');
                    }
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tài khoản đã tồn tại!']);
                    redirect('index.php?option=user&act=insert');
                }
            }
            require_once $path . 'insert.php';
            break;
        case 'update':
            $id = $_REQUEST['id'];
            $row = user_getid($id);
            if (isset($_POST['CAPNHAT'])) {
                if (user_exists($email, $id) == FALSE) {
                    if ($repassword == $password) {
                        // Xử lý hình ảnh (chỉ khi người dùng thay đổi hình ảnh)
                        if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
                            if (file_exists('../public/images/user/' . $row['img'])) {
                                unlink('../public/images/user/' . $row['img']);
                            }
                            // Kiểm tra nếu file không rỗng
                            $file_name = $_FILES['img']['name'];
                            $file_tmp_name = $_FILES['img']['tmp_name'];
                            $upload_path = '../public/images/user/' . $file_name;
                            if (!move_uploaded_file($file_tmp_name, $upload_path)) {
                                //Lỗi trong quá trình xử lý upload
                                set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
                                redirect('index.php?option=user&act=update&id=' . $id);
                            }
                            $img = $file_name;
                        } else {
                            $img = $row['img'];
                        }
                        user_update($fullname, $password, $email, $address, $gender,  $phone, $img, $role, $status, $id);
                        set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật quản trị viên thành công!']);
                        redirect('index.php?option=user');
                    } else {
                        set_flash('message', ['type' => 'warning', 'msg' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp!']);
                        redirect('index.php?option=user&act=update&id=' . $id);
                    }
                } else {
                    set_flash('message', ['type' => 'warning', 'msg' => 'Tài khoản đã tồn tại!']);
                    redirect('index.php?option=user&act=update&id=' . $id);
                }
            }
            require_once $path . 'update.php';
            break;
        case 'deltrash':
            $id = $_REQUEST['id'];
            $row = user_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=user');
            } else {
                $status = 0;
                user_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Đưa tài khoản vào thùng rác thành công']);
                redirect('index.php?option=user');
            }
            break;
        case 'retrash':
            $id = $_REQUEST['id'];
            $row = user_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=user&act=trash');
            } else {
                $status = 2;
                user_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Khôi phục tài khoản thành công']);
                redirect('index.php?option=user&act=trash');
            }
            break;
        case 'status':
            $id = $_REQUEST['id'];
            $row = user_getid($id);
            $status = ($row['status'] == 1) ? 2 : 1;
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                header('index.php?option=user');
            } else {
                user_update_status($status, $id);
                set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật trạng thái tài khoản thành công']);
                redirect('index.php?option=user');
            }
            break;
        case 'trash':
            $list_user = user_all('trash');
            require_once $path . 'trash.php';
            break;
        case 'delete':
            $id = $_REQUEST['id'];
            $row = user_getid($id);
            if ($row == NULL) {
                set_flash('message', ['type' => 'error', 'msg' => 'Người dùng này không tồn tại!']);
                redirect('index.php?option=user&act=trash');
            } else {
                if ($row['id'] === 1) {
                    set_flash('message', ['type' => 'error', 'msg' => 'Không được quyền xoá quản trị viên này!']);
                    redirect('index.php?option=user');
                } else {
                    //Xoá Người dùng
                    if (file_exists('../public/images/user/' . $row['img'])) {
                        unlink('../public/images/user/' . $row['img']);
                    }
                    user_delete($id);
                    set_flash('message', ['type' => 'success', 'msg' => 'Xoá Người dùng thành công']);
                    redirect('index.php?option=user&act=trash');
                }
            }
            break;
        default:
            $list_user = user_all('index');
            require_once $path . 'index.php';
            break;
    }
} else {
    $list_user = user_all('index');
    require_once $path . 'index.php';
}
