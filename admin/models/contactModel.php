<?php
function contact_list($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_contact WHERE isDeleted = 1";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_contact WHERE isDeleted = 0";
        return pdo_query_all($sql);
    }
}
function contact_rowid($id)
{
    $sql = "SELECT * FROM db_contact WHERE id=?";
    return pdo_query_one($sql, $id);
}
function contact_update($contact_return, $status, $id)
{
    $sql = "UPDATE db_contact SET contact_reply=?,status=? WHERE id=?";
    // $sql = "UPDATE db_contact SET contact_return=$contact_return,status=$status WHERE id=$id";
    $result = pdo_execute($sql, $contact_return, $status, $id);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function contact_deltrash($isDeleted, $id)
{
    $sql = "UPDATE db_contact SET isDeleted=? WHERE id=?";
    return pdo_execute($sql, $isDeleted, $id);
}
function contact_delete($id)
{
    $sql = "DELETE FROM db_contact WHERE id=?";
    return pdo_execute($sql, $id);
}
