<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function brand_all($page)
{
    if ($page == 'index') {
        $sql = "SELECT * FROM db_brand WHERE status!=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    } else {
        $sql = "SELECT * FROM db_brand WHERE status=0 ORDER BY orders ASC";
        return pdo_query_all($sql);
    }
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function brand_rowid($id)
{
    $sql = "SELECT * FROM db_brand WHERE id = ?";
    return pdo_query_one($sql, $id);
}
function brand_name_id($id)
{
    $sql = "SELECT * FROM db_brand WHERE id = ?";
    $result = pdo_query_one($sql, $id);
    return $result['slug'];
}
function brand_rowslug($slug)
{
    $sql = "SELECT * FROM db_brand WHERE slug = ?";
    return pdo_query_one($sql, $slug);
}
//Kiểm tra xem tên brand có tồn tại hay chưa dựa trên slug
function brand_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_brand WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_brand WHERE slug=? AND id!=?";
        return pdo_query_one($sql, $slug, $id);
    }
}
//Kiểm tra xem brand có tồn tại sản phẩm không dựa theo brand_id của bảng product
function brand_has_products($id)
{
    $sql = "SELECT COUNT(*) FROM db_product WHERE brand_id = ?";
    return pdo_query_value($sql, $id) > 0;
}
//Thêm thương hiệu
function brand_insert($name, $slug, $img, $orders, $status)
{
    $sql = "INSERT INTO db_brand (name,slug,img,orders,status) VALUES(?,?,?,?,?)";
    return pdo_execute($sql, $name, $slug, $img, $orders, $status);
}
//Cập nhật thông tin thương hiệu
function brand_update($name, $slug, $img, $orders, $status, $id)
{
    $sql = "UPDATE db_brand SET name=?,slug=?,img=?,orders=?,status=? WHERE id=?";
    return pdo_execute($sql, $name, $slug, $img, $orders, $status, $id);
}
//Cập nhật trạng thái thương hiệu
function brand_update_status($status, $id)
{
    $sql = "UPDATE db_brand SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function brand_delete($id)
{
    $sql = "DELETE FROM db_brand WHERE id=?";
    return pdo_execute($sql, $id);
}
