<?php
function menu_all($position = null)
{
    if ($position) {
        $sql = "SELECT * FROM db_menu WHERE status!=0 AND position=? ORDER BY orders ASC";
        return pdo_query_all($sql, $position);
    } else {
        $sql = "SELECT * FROM db_menu WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
function menu_list_parentid($position, $parentid = 0)
{
    $sql = "SELECT * FROM db_menu WHERE parentid=? AND status=1 AND position='?' ORDER BY orders";
    return pdo_query_all($sql, $position, $parentid);
}
function menu_rowid($id)
{
    $sql = "SELECT * FROM db_menu WHERE id=?";
    return pdo_query_one($sql, $id);
}
function menu_insert($name, $type, $link, $table_id, $parent_id, $orders, $position, $status)
{
    $sql = "INSERT INTO db_menu (name,type,link,table_id,parent_id,orders,position,status) 
    VALUES(?,?,?,?,?,?,?,?)";
    return pdo_execute($sql, $name, $type, $link, $table_id, $parent_id, $orders, $position, $status);
}
function menu_update($name, $link, $parent_id, $orders, $status, $id)
{
    $sql = "UPDATE db_menu SET name=?,link=?,parent_id=?,orders=?,status=? WHERE id=?";
    return pdo_execute($sql, $name, $link, $parent_id, $orders, $status, $id);
}
function menu_status($status, $id)
{
    $sql = "UPDATE db_menu SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
function check_active_children($id)
{
    // Kiểm tra xem có menu con đang hoạt động không
    $sql = "SELECT * FROM db_menu WHERE parent_id=? AND status=1";
    $count = count(pdo_query_all($sql, $id));
    if ($count > 0) {
        return true;
    } else {
        return false;
    }
}

function menu_delete($id)
{
    $sql = "DELETE FROM db_menu WHERE id=?";
    return pdo_execute($sql, $id);
}
