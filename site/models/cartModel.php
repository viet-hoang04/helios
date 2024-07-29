<?php
function cart_content()
{
    if (isset($_SESSION['cart'])) {
        $cart = array_values($_SESSION['cart']); //Row cart là mảng 2 chiều
        return $cart;
    }
    return NULL;
}
function cart_insert($data)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = $data;
    } else {
        $cart = $_SESSION['cart'];
        $existing_product_key = null;

        // Kiểm tra xem sản phẩm với kích thước tương ứng đã tồn tại trong giỏ hàng chưa
        foreach ($cart as $key => $item) {
            if ($item['id'] == $data['id'] && $item['size'] == $data['size']) {
                $existing_product_key = $key;
                break;
            }
        }

        if ($existing_product_key !== null) {
            // Nếu sản phẩm với kích thước tương ứng đã tồn tại, thì cập nhật số lượng
            $cart[$existing_product_key]['qty'] += $data['qty'];
        } else {
            // Nếu sản phẩm với kích thước tương ứng chưa tồn tại, thêm sản phẩm mới
            $cart[] = $data;
        }

        $_SESSION['cart'] = $cart;
    }
}

function cart_check_product($data)
{
    $cart = cart_content();
    foreach ($cart as $item) {
        if ($item['id'] == $data['id']) {
            return TRUE;
        }
    }
    return FALSE;
}
function cart_update($data)
{
    $cart = cart_content();
    foreach ($cart as $key => $item) {
        if ($item['id'] == $data[$key]['id']) {
            if ($data[$key]['qty'] == 0) {
                cart_delete($item['id']);
            } else {
                $cart[$key]['qty'] = $data[$key]['qty']; //Thay đổi số lượng sp 
            }
        }
    }
    $_SESSION['cart'] = array_values($cart);
}
function cart_update_qty($cart, $data)
{
    foreach ($cart as $key => $item) {
        if ($item['id'] == $data['id']) {
            $cart[$key]['qty'] += $data['qty']; //Thay đổi số lượng sp 
        }
    }
    return $cart;
}
function cart_total()
{
    if (!isset($_SESSION['cart'])) {
        return 0;
    } else {
        $cart = $_SESSION['cart'];
        return count($cart);
    }
}
function cart_total_product()
{
    if (!isset($_SESSION['cart'])) {
        return 0;
    } else {
        $cart = $_SESSION['cart'];
        $number = 0;
        foreach ($cart as $item) {
            $number += $item['qty'];
        }
        return $number;
    }
}
function cart_total_price()
{
    if (!isset($_SESSION['cart'])) {
        return 0;
    } else {
        $cart = $_SESSION['cart'];
        $total_price = 0;

        foreach ($cart as $item) {
            $total_price += $item['qty'] * $item['price'];
        }

        return $total_price;
    }
}


function cart_delete($id = null)
{
    if ($id == null) {
        unset($_SESSION['cart']);
    } else {
        $cart = cart_content();
        if ($cart != null) {
            foreach ($cart as $key => $item) {
                if ($item['id'] == $id) {
                    unset($cart[$key]);
                    $cart = array_values($cart);
                    break;
                }
            }
        }
        $_SESSION['cart'] = $cart;
    }
}
function get_last_order_id()
{
    $sql = "SELECT * FROM db_order ORDER BY id DESC LIMIT 1";
    $result = pdo_query_one($sql);
    return $result["id"];
}
function  cart_insert_orders($user_id, $delivery_fullname, $delivery_address, $delivery_phone, $delivery_email, $created_at, $exported_at, $total_price, $payment_method, $note, $list)
{
    //thêm đơn hàng
    $sql_order = "INSERT INTO db_order(user_id,delivery_fullname, delivery_address, delivery_phone, delivery_email, created_at, exported_at, total_price, payment_method, note) VALUES(?,?,?,?,?,?,?,?,?,?)";
    pdo_execute($sql_order, $user_id, $delivery_fullname, $delivery_address, $delivery_phone, $delivery_email, $created_at, $exported_at, $total_price, $payment_method, $note);
    $last_order_id = get_last_order_id();
    // Chèn chi tiết đơn hàng
    foreach ($list as $item) {
        $product_id = $item['id'];
        $material = $item['material'];
        $size = $item['size'];
        $price = $item['price'];
        $quantity = $item['qty'];

        $sql_orderdetail = "INSERT INTO db_orderdetail (order_id, product_id, material, size, price, quantity) VALUES (?,?,?,?,?,?)";
        pdo_execute($sql_orderdetail, $last_order_id, $product_id, $material, $size, $price, $quantity);
    }
}
