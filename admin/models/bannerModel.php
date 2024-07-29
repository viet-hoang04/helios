<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function banner_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_banner WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_banner WHERE status=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function banner_rowid($id)
{
    $sql = "SELECT * FROM db_banner WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function banner_insert($name, $link, $position, $info1, $info2, $info3, $img, $orders, $status)
{
    $sql = "INSERT INTO db_banner (name,link,position,info1,info2,info3,img,orders,status) VALUES (?,?,?,?,?,?,?,?,?)";
    return pdo_execute($sql, $name, $link, $position, $info1, $info2, $info3, $img, $orders, $status);
}
//Cập nhật thông tin thương hiệu
function banner_update($name, $link, $position, $info1, $info2, $info3, $img, $orders, $status, $id)
{
    $sql = "UPDATE db_banner SET name=?,link=?,position=?,info1=?,info2=?,info3=?,img=?,orders=?,status=? WHERE id=?";
    return pdo_execute($sql, $name, $link, $position, $info1, $info2, $info3, $img, $orders, $status, $id);
}
//Cập nhật trạng thái thương hiệu
function banner_update_status($status, $id)
{
    $sql = "UPDATE db_banner SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function banner_delete($id)
{
    $sql = "DELETE FROM db_banner WHERE id=?";
    return pdo_execute($sql, $id);
}
