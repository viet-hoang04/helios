<?php
function validateEmail($email)
{
    $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$validEmail) {
        return false; // Invalid email format
    }

    $domain = explode('@', $email)[1];
    $mxRecord = checkdnsrr($domain, 'MX');
    $sql = "SELECT COUNT(*) as count FROM db_user WHERE email = ?";
    $count = pdo_query_value($sql, $email);
    return $mxRecord && $count !== null && $count == 0;
}
function validatePassword($password, $repassword = null)
{
    $errors = [];

    if (empty($password)) {
        $errors[] = "Vui lòng nhập mật khẩu.";
    }

    if ($repassword !== null && $password !== $repassword) {
        $errors[] = "Mật khẩu nhập lại không khớp.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Mật khẩu phải có ít nhất 8 ký tự.";
    }

    // Kiểm tra có ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#\$%\^&\*\(\)_\+\-=\[\]\{\};:\'",<>\.\?\/\\|`~])/', $password)) {
        $errors[] = "Mật khẩu phải có ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt.";
    }

    return $errors;
}

function handleImageUpload()
{
    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
        if (file_exists('../public/images/user/' . $_SESSION['user']['img'])) {
            unlink('../public/images/user/' . $_SESSION['user']['img']);
        }
        $file_name = $_FILES['img']['name'];
        $file_tmp_name = $_FILES['img']['tmp_name'];
        $upload_path = '../public/images/user/' . $file_name;
        if (!move_uploaded_file($file_tmp_name, $upload_path)) {
            set_flash('message', ['type' => 'warning', 'msg' => 'Lỗi upload hình ảnh!']);
            header('Location: index.php?option=user&act=account-detail');
            exit();
        }
        return $file_name;
    }
    return $_SESSION['user']['img'];
}

function validateAndUpdate($fullname, $password, $email, $address, $gender, $phone, $img)
{
    $fullname_error = $phone_error = $gender_error = '';

    // Validate fullname
    if (empty($fullname)) {
        $fullname_error = "Vui lòng nhập họ và tên.";
    }

    // Validate phone
    if (empty($phone)) {
        $phone_error = "Vui lòng nhập số điện thoại.";
    }

    // Validate gender 
    if (empty($gender) && $gender !== 0) {
        $gender_error = "Vui lòng chọn giới tính.";
    }
    // If there are validation errors, handle them
    if (empty($fullname_error) && empty($phone_error) && empty($gender_error)) {
        $update_result = customer_update($fullname, $password, $email, $address, $gender, $phone, $img, $_SESSION['user']['id']);
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['fullname'] = $fullname;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['gender'] = $gender;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['img'] = $img;

        // Check the result of the update
        if ($update_result) {
            set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thông tin mới thành công!']);
        } else {
            set_flash('message', ['type' => 'warning', 'msg' => 'Có lỗi xảy ra trong quá trình cập nhật. Vui lòng kiểm tra lại.']);
        }
        header('Location: index.php?option=user&act=account-detail');
        exit();
    }
}
