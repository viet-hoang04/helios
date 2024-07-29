<?php
function statistic_product_by_category()
{
    $sql = "SELECT c.name,count(p.id) as so_luong_san_pham FROM db_category c
        LEFT JOIN db_product p ON c.id = p.category_id
         GROUP BY c.name";
    return pdo_query_all($sql);
}
function statistic_category()
{
    $sql = "SELECT status,count(id) as so_luong_danh_muc FROM db_category GROUP BY status";
    return pdo_query_all($sql);
}
function statistic_order_by_stage()
{
    $sql = "SELECT COUNT(*) AS so_luong,stage as trang_thai_don_hang FROM db_order GROUP BY stage";
    return pdo_query_all($sql);
}
function product_all_count()
{
    $sql = "SELECT * FROM db_product";
    return count(pdo_query_all($sql));
}
function post_all_count()
{
    $sql = "SELECT * FROM db_post";
    return count(pdo_query_all($sql));
}

function user_all_count()
{
    $sql = "SELECT * FROM db_user";
    return count(pdo_query_all($sql));
}

function order_all_count()
{
    $sql = "SELECT * FROM db_order";
    return count(pdo_query_all($sql));
}
