<?php
function config_all()
{
    $sql = "SELECT * FROM db_config WHERE id=1";
    return pdo_query_one($sql);
}
function config_rowid($id)
{
    $sql = "SELECT * FROM db_config WHERE id=?";
    return pdo_query_one($sql, $id);
}
function config_update($title, $logo, $icon, $url, $address, $map, $phone, $email, $id)
{
    $sql = "UPDATE db_config set title=?,logo=?,icon=?,url=?,address=?,map=?,phone=?,email=? WHERE id=?";
    return pdo_execute($sql, $title, $logo, $icon, $url, $address, $map, $phone, $email, $id);
}
