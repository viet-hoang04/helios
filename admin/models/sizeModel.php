<?php
function size_all()
{
    $sql = "SELECT * FROM db_size";
    return pdo_query_all($sql);
}
function size_by_id($id)
{
    $sql = "SELECT * FROM db_size WHERE id =?";
    return pdo_query_one($sql, $id);
}
function get_size_by_product_id_index($product_id)
{
    $sql = "SELECT db_size.*
            FROM db_size
            JOIN db_product_size ON db_size.id = db_product_size.size_id
            WHERE db_product_size.product_id = ?";
    return pdo_query_all($sql, $product_id);
}
function get_size_by_product_id($product_id)
{
    $sql = "SELECT size_id FROM db_product_size WHERE product_id = ?";
    return pdo_query_all($sql, $product_id);
}

function size_insert($name_size, $rate)
{
    $sql = "INSERT INTO db_size (name_size,rate) VALUES(?,?)";
    $result = pdo_execute($sql, $name_size, $rate);
    return $result;
}

function size_update($name_size, $rate, $id)
{
    $sql = "UPDATE db_size SET name_size=?,rate=? WHERE id=?";
    $result = pdo_execute($sql, $name_size, $rate, $id);
    return $result;
}
// function product_size_price($size_id, $product_id, $price)
// {
//     $size = implode(', ', $size_id);
//     // $product = product_rowid($product_id);
//     //size_id hiện tại nó là 1 mảng [1,2,3,4,5]
//     foreach ($size_id as $k => $size_one_id) {
//         $size = size_by_id($size_one_id);
//         $temp_price = $price + ($size['rate'] * $price);
//         $sql = "INSERT INTO db_product_size (product_id,size_id,temp_price) VALUES (?,?,?)";
//         // var_dump($sql);
//         pdo_execute($sql, $product_id, $size_one_id, $temp_price);
//     }

//     //temp_price = product_price + (product_price * rate);
// }
function product_temp_price($size_id, $product_id, $price, $material_id)
{
    foreach ($size_id as $k => $size_one_id) {
        $size = size_by_id($size_one_id);
        $material_info = material_by_id($material_id);

        // Lấy giá trị rate từ size và material
        $size_rate = $size['rate'];
        $material_rate = $material_info['rate'];

        // Tính toán temp_price
        $temp_price = $price + ($size_rate * $price) + ($material_rate * $price);

        $sql = "INSERT INTO db_product_size (product_id, size_id, temp_price) VALUES (?, ?, ?)";
        pdo_execute($sql, $product_id, $size_one_id, $temp_price);
    }
}

function product_size_delete_by_product_id($product_id)
{
    $sql = "DELETE FROM db_product_size WHERE product_id = ?";
    pdo_execute($sql, $product_id);
}
