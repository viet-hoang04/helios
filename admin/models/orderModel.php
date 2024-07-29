<?php
function order_all($page = 'index')
{
    if ($page == 'index') {
        $sql = "SELECT o.*, u.fullname as customer_name, r.name as rank_name, r.img as rank_img
            FROM db_order o
            JOIN db_user u ON o.user_id = u.id
            JOIN db_member_rank r ON u.rank_id = r.id
            WHERE o.status = 0 AND o.stage NOT IN (3, 7)
            ORDER BY o.id DESC";
    } else {
        $sql = "SELECT o.*, u.fullname as customer_name, r.name as rank_name, r.img as rank_img
            FROM db_order o
            JOIN db_user u ON o.user_id = u.id
            JOIN db_member_rank r ON u.rank_id = r.id
            WHERE o.status != 0 OR o.stage IN (3, 7)
            ORDER BY o.id DESC";
    }
    return pdo_query_all($sql);
}

function order_rowid($id)
{
    $sql = "SELECT * FROM db_order WHERE id=?";
    return pdo_query_one($sql, $id);
}
function updatePriceSpent($order_id)
{
    $totalPrice = pdo_query_value("SELECT total_price FROM db_order WHERE id = ?", $order_id);

    if ($totalPrice > 0) {
        $userId = pdo_query_value("SELECT user_id FROM db_order WHERE id = ?", $order_id);
        pdo_execute("UPDATE db_user SET price_spent = price_spent + ? WHERE id = ?", $totalPrice, $userId);
    }
}
function order_update_stage($stage, $order_id)
{
    if ($stage == 3) {
        $sql = "UPDATE db_order SET stage = ?, status = 2 WHERE id = ?";
    } elseif ($stage == 7) {
        $sql = "UPDATE db_order SET stage = ?, status = 1 WHERE id = ?";
        // Gọi hàm để cập nhật price_spent
        updatePriceSpent($order_id);
        // Lấy giá trị price_spent từ db_user
        $priceSpent = pdo_query_value("SELECT price_spent FROM db_user WHERE id = (SELECT user_id FROM db_order WHERE id = ?)", $order_id);
        $user_id = pdo_query_value("SELECT user_id FROM db_order WHERE id = ?", $order_id);

        // Gọi hàm để cập nhật rank
        updateMemberRank($user_id, $priceSpent);
        updateProductQuantities($order_id);
    } else {
        $sql = "UPDATE db_order SET stage = ? WHERE id = ?";
    }

    // Cập nhật trạng thái chính
    pdo_execute($sql, $stage, $order_id);
}
function updateProductQuantities($order_id)
{
    // Truy vấn để lấy thông tin chi tiết đơn hàng
    $orderDetails = pdo_query_all("SELECT product_id, quantity FROM db_orderdetail WHERE order_id = ?", $order_id);

    foreach ($orderDetails as $detail) {
        $productId = $detail['product_id'];
        $quantity = $detail['quantity'];

        // Truy vấn để cập nhật tổng quantity cho sản phẩm trong bảng db_product
        pdo_execute("UPDATE db_product SET quantity = quantity - ? WHERE id = ?", $quantity, $productId);

        // Truy vấn để cập nhật số lượng đã bán cho sản phẩm trong bảng db_product
        pdo_execute("UPDATE db_product SET sold_count = sold_count + ? WHERE id = ?", $quantity, $productId);
        // Truy vấn để kiểm tra và cập nhật trạng thái sản phẩm nếu quantity dưới 5
        $productQuantity = pdo_query_value("SELECT quantity FROM db_product WHERE id = ?", $productId);
        if ($productQuantity < 5) {
            pdo_execute("UPDATE db_product SET status = 2 WHERE id = ?", $productId);
        }
    }
}


function updateMemberRank($user_id, $priceSpent)
{
    $ranks = pdo_query_all("SELECT * FROM db_member_rank ORDER BY `condition` DESC");

    if ($ranks) {  // Kiểm tra xem có dữ liệu trong bảng db_member_rank hay không
        foreach ($ranks as $rank) {
            if ($priceSpent >= $rank['condition']) {
                pdo_execute("UPDATE db_user SET rank_id = ? WHERE id = ?", $rank['id'], $user_id);
                break;
            }
        }
    }
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
function order_update_status($status, $id)
{
    $sql = "UPDATE db_order SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
