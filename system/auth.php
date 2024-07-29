<?php
function auth_check($email)
{
    $sql = "SELECT count(*) FROM db_user WHERE email=? AND status=1";
    return pdo_query_value($sql, $email) > 0;
}
function auth_guard($email, $password)
{
    $sql = "SELECT * FROM db_user WHERE email=? AND password=? AND status=1";
    $result = pdo_query_one($sql, $email, $password);

    if ($result) {
        return $result;
    }

    return FALSE;
}
