<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function singlepage_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_post WHERE status!=0 AND type='singlepage' ORDER BY id ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_post WHERE status=0 AND type='singlepage' ORDER BY id ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function singlepage_rowid($id)
{
    $sql = "SELECT * FROM db_post WHERE id = ?";
    return pdo_query_one($sql, $id);
}
function singlepage_rowslug($slug)
{
    $sql = "SELECT * FROM db_post WHERE slug = ?";
    return pdo_query_one($sql, $slug);
}
//Kiểm tra xem tên singlepage có tồn tại hay chưa dựa trên slug
function singlepage_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_post WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_post WHERE slug=? AND id=!?";
        return pdo_query_one($sql, $slug, $id);
    }
}
//Thêm thương hiệu
function singlepage_insert($topic_id, $title, $slug, $detail, $img, $type, $status)
{
    $sql = "INSERT INTO db_post (topic_id,title,slug,detail,img,type,status) VALUES (?,?,?,?,?,?,?)";
    return pdo_execute($sql, $topic_id, $title, $slug, $detail, $img, $type, $status);
}
function singlepage_update($title, $slug, $detail, $img, $status, $id)
{
    $sql = "UPDATE db_post SET title=?,slug=?,detail=?,img=?,status=? WHERE id=?";
    return pdo_execute($sql, $title, $slug, $detail, $img, $status, $id);
}
function singlepage_update_status($status, $id)
{
    $sql = "UPDATE db_post SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
function singlepage_delete($id)
{
    $sql = "DELETE FROM db_post WHERE id=?";
    return pdo_execute($sql, $id);
}
