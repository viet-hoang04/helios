<?php

function rank_all()
{
    $sql = "SELECT * FROM db_member_rank";
    return pdo_query_all($sql);
}
function rank_rowid($id)
{
    $sql = "SELECT * FROM db_member_rank WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function rank_insert($name, $img, $promotion, $condition, $status)
{
    $sql = "INSERT INTO db_member_rank (name,img,promotion,condition_column,status) VALUES (?,?,?,?,?)";
    $result = pdo_execute($sql, $name, $img, $promotion, $condition, $status);
    return $result;
}
function rank_update($name, $img, $promotion, $condition, $status, $id)
{
    $sql = "UPDATE db_member_rank SET name=?,img=?,promotion=?,condition_column=?,status=? WHERE id=?";
    $result = pdo_execute($sql, $name, $img, $promotion, $condition, $status, $id);
    return $result;
}
function rank_update_status($status, $id)
{
    $sql = "UPDATE db_member_rank SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
function rank_delete($id)
{
    $sql = "DELETE FROM db_member_rank WHERE id=?";
    return pdo_execute($sql, $id);
}
