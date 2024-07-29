<?php
function contact_insert($fullname, $email, $phone, $title, $detail, $status, $isDeleted)
{
    $sql = "INSERT INTO db_contact (fullname,email,phone,title,detail,status,isDeleted) 
            VALUES (?,?,?,?,?,?,?)";
    pdo_execute($sql, $fullname, $email, $phone, $title, $detail, $status, $isDeleted);
}
