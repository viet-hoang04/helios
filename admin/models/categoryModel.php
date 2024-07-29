<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function category_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_category WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_category WHERE status=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function category_rowid($id)
{
    $sql = "SELECT * FROM db_category WHERE id = ?";
    return pdo_query_one($sql, $id);
}
function category_name_id($id)
{
    $sql = "SELECT * FROM db_category WHERE id = ?";
    $result = pdo_query_one($sql, $id);
    return $result['slug'];
}
//Kiểm tra xem tên category có tồn tại hay chưa dựa trên slug
function category_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_category WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_category WHERE slug=? AND id!=?";
        return pdo_query_one($sql, $slug, $id);
    }
}
//Kiểm tra xem category có tồn tại sản phẩm không dựa theo category_id của bảng product
function category_has_children($id)
{
    // Thực hiện truy vấn kiểm tra xem có danh mục con nào có parentid = $id hay không
    $sql = "SELECT COUNT(*) FROM db_category WHERE parent_id = ?";
    $count = pdo_query_value($sql, $id);
    return $count > 0;
}
//Thêm thương hiệu
function category_insert($name, $slug, $parent_id, $orders, $status)
{
    $sql = "INSERT INTO db_category (name,slug,parent_id,orders,status) VALUES(?,?,?,?,?)";
    return pdo_execute($sql, $name, $slug, $parent_id, $orders, $status);
}
//Cập nhật thông tin thương hiệu
function category_update($name, $slug, $parent_id,  $orders, $status, $id)
{
    $sql = "UPDATE db_category SET name=?,slug=?,parent_id=?,orders=?,status=? WHERE id=?";
    return pdo_execute($sql, $name, $slug, $parent_id, $orders, $status, $id);
}
//Cập nhật trạng thái thương hiệu
function category_update_status($status, $id)
{
    $sql = "UPDATE db_category SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function category_delete($id)
{
    $sql = "DELETE FROM db_category WHERE id=?";
    return pdo_execute($sql, $id);
}
