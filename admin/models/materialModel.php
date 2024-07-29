<?php
function material_all()
{
    $sql = "SELECT * FROM db_material";
    return pdo_query_all($sql);
}
function material_by_id($id)
{
    $sql = "SELECT * FROM db_material WHERE id=?";
    return pdo_query_one($sql, $id);
}
function material_insert($name, $rate)
{
    $sql = "INSERT INTO db_material (name,rate) VALUES(?,?)";
    $result = pdo_execute($sql, $name, $rate);
    return $result;
}
function material_update($name, $rate, $id)
{
    $sql = "UPDATE db_material SET name=?,rate=? WHERE id=?";
    $result = pdo_execute($sql, $name, $rate, $id);
    return $result;
}
