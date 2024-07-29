<?php
function customer_by_id($id)
{
    $sql = "SELECT * FROM db_user WHERE id = ?";
    return pdo_query_one($sql, $id);
}
function get_rank_user($user_id)
{
    $sql = "SELECT m.* 
    FROM db_member_rank m
    JOIN db_user u ON u.rank_id = m.id
    WHERE u.id =?";
    return pdo_query_one($sql, $user_id);
}
function get_rank_img($id)
{
    $sql = "SELECT * FROM db_member_rank WHERE id=?";
    $result = pdo_query_one($sql, $id);
    return $result["img"];
}
function customer_insert($fullname, $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status)
{
    $sql = "INSERT INTO db_user (fullname,password,email,address,gender,phone,img,role,rank_id,status) VALUES(?,?,?,?,?,?,?,?,?,?)";
    $result = pdo_execute($sql, $fullname, $password, $email, $address, $gender, $phone, $img, $role, $rank_id, $status);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function customer_update($fullname, $password, $email, $address, $gender, $phone, $img, $id)
{
    $sql = "UPDATE db_user SET fullname=?,password=?,email=?,address=?,gender=?,phone=?,img=? WHERE id=?";
    $result = pdo_execute($sql, $fullname, $password, $email, $address, $gender, $phone, $img, $id);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
