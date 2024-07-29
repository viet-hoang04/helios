<?php
function customer_all($page = 'index')
{
    if ($page == 'index') {
        $sql = "SELECT u.*, r.name AS rank_name
        FROM db_user u
        JOIN db_member_rank AS r ON u.rank_id = r.id
        WHERE u.role='customer' AND u.status !=0 ORDER BY u.id DESC";
    } else {
        $sql = "SELECT u.*, r.name AS rank_name
        FROM db_user u
        JOIN db_member_rank AS r ON u.rank_id = r.id
        WHERE u.role='customer' AND u.status =0 ORDER BY u.id DESC";
    }
    return pdo_query_all($sql);
}
function customer_insert($fullname,  $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status)
{
    $sql = "INSERT INTO db_user(fullname,password,email,address,gender,phone,img,role,rank_id,status) 
    VALUES(?,?,?,?,?,?,?,?,?,?)";
    // $sql = "INSERT INTO db_user(fullname,password,email,address,gender,phone,img,role,rank_id,status) 
    // VALUES($fullname, $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status)";
    // var_dump($sql);
    pdo_execute($sql, $fullname, $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status);
}
function customer_exists($email, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_user WHERE email=?";
        return pdo_query_one($sql, $email);
    } else {
        $sql = "SELECT * FROM db_user WHERE email=? AND id!=?";
        return pdo_query_one($sql, $email, $id);
    }
}
function customer_getid($id)
{
    $sql = "SELECT * FROM db_user WHERE id=?";
    return pdo_query_one($sql, $id);
}
function customer_update($fullname,  $password, $email, $address, $gender, $phone, $img, $status, $id)
{
    $sql = "UPDATE db_user SET fullname=?,password=?,email=?,address=?,gender=?,phone=?,img=?,status=? WHERE id=?";
    return pdo_execute($sql, $fullname, $password, $email, $address, $gender, $phone, $img, $status, $id);
}
function customer_update_status($status, $id)
{
    $sql = "UPDATE db_user SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
function customer_delete($id)
{
    $sql = "DELETE FROM db_user WHERE id=?";
    return pdo_execute($sql, $id);
}
