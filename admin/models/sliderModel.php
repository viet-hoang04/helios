<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function slider_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_slider WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_slider WHERE status=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function slider_rowid($id)
{
    $sql = "SELECT * FROM db_slider WHERE id = ?";
    return pdo_query_one($sql, $id);
}

function slider_insert($name, $link, $position, $info1, $info2, $info3, $img, $orders, $status)
{
    $sql = "INSERT INTO db_slider (name,link,position,info1,info2,info3,img,orders,status) VALUES (?,?,?,?,?,?,?,?,?)";
    return pdo_execute($sql, $name, $link, $position, $info1, $info2, $info3, $img, $orders, $status);
}
//Cập nhật thông tin thương hiệu
function slider_update($name, $link, $info1, $info2, $info3, $img, $orders, $status, $id)
{
    $sql = "UPDATE db_slider SET name=?,link=?,info1=?,info2=?,info3=?,img=?,orders=?,status=? WHERE id=?";
    return pdo_execute($sql, $name, $link, $info1, $info2, $info3, $img, $orders, $status, $id);
}
//Cập nhật trạng thái thương hiệu
function slider_update_status($status, $id)
{
    $sql = "UPDATE db_slider SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function slider_delete($id)
{
    $sql = "DELETE FROM db_slider WHERE id=?";
    return pdo_execute($sql, $id);
}
