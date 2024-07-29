<?php
function list_order_by_userid($user_id)
{
    $sql = "SELECT * FROM db_order WHERE user_id=?";
    return pdo_query_all($sql, $user_id);
}
function get_order_details_by_order_id($order_id)
{
    $sql = "SELECT
                od.*,
                p.name AS product_name,
                (SELECT pi.image FROM db_product_img pi WHERE pi.product_id = od.product_id LIMIT 1) AS product_img_first
            FROM
                db_orderdetail od
            JOIN
                db_product p ON od.product_id = p.id
            WHERE
                od.order_id=?";

    return pdo_query_all($sql, $order_id);
}
function cancel_order($order_id)
{
    $sql = "UPDATE db_order SET stage=3, status=2 WHERE id=?";
    $result = pdo_execute($sql, $order_id);
    return $result;
}
