<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function topic_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_topic WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_topic WHERE status=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function topic_rowid($id)
{
    $sql = "SELECT * FROM db_topic WHERE id = ?";
    return pdo_query_one($sql, $id);
}
//Kiểm tra xem tên topic có tồn tại hay chưa dựa trên slug
function topic_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_topic WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_topic WHERE slug=? AND id!=?";
        return pdo_query_one($sql, $slug, $id);
    }
}
//Kiểm tra xem topic có tồn tại sản phẩm không dựa theo topic_id của bảng product
function topic_has_children($id)
{
    // Thực hiện truy vấn kiểm tra xem có danh mục con nào có parentid = $id hay không
    $sql = "SELECT COUNT(*) FROM db_topic WHERE parent_id = ?";
    $count = pdo_query_value($sql, $id);
    return $count > 0;
}
function topic_has_products($id)
{
    $sql = "SELECT COUNT(*) FROM db_product WHERE topic_id = ?";
    return pdo_query_value($sql, $id) > 0;
}
//Thêm thương hiệu
function topic_insert($name, $slug, $parent_id, $orders, $status)
{
    $sql = "INSERT INTO db_topic (name,slug,parent_id,orders,status) VALUES(?,?,?,?,?)";
    pdo_execute($sql, $name, $slug, $parent_id, $orders, $status);
}
//Cập nhật thông tin thương hiệu
function topic_update($name, $slug, $parent_id,  $orders, $status, $id)
{
    $sql = "UPDATE db_topic SET name=?,slug=?,parent_id=?,orders=?,status=? WHERE id=?";
    pdo_execute($sql, $name, $slug, $parent_id, $orders, $status, $id);
}
//Cập nhật trạng thái thương hiệu
function topic_update_status($status, $id)
{
    $sql = "UPDATE db_topic SET status=? WHERE id=?";
    pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function topic_delete($id)
{
    $sql = "DELETE FROM db_topic WHERE id=?";
    return pdo_execute($sql, $id);
}
