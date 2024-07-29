<?php
function product_imglist($product_id)
{
    $sql = "SELECT * FROM db_product_img WHERE product_id = ?";
    return pdo_query_all($sql, $product_id);
}
function product_imglist_insert($product_id, $image_list)
{
    foreach ($image_list as $k => $v) {
        $img = $v;
        $sql_img = "INSERT INTO db_product_img (product_id, image) VALUES (?,?)";
        // var_dump($sql_img);
        pdo_execute($sql_img, $product_id, $img);
    }
}
function imglist_updated($productid, $image_list)
{
    foreach ($image_list as $k => $v) {
        $img = $v;
        $sql_img = "INSERT INTO db_imglist (productid, img) VALUES (?, ?)";
        pdo_execute($sql_img, $productid, $img);
    }
}
function product_imglist_folder_delete($product_id)
{
    $imglist = product_imglist($product_id);
    foreach ($imglist as $item) {
        $name = $item["image"];
        if (file_exists('../public/images/product/' . $name)) {
            unlink('../public/images/product/' . $name);
        }
    }
}
function product_imglist_delete($product_id)
{
    $sql = "DELETE FROM db_product_img WHERE product_id=?";
    pdo_execute($sql, $product_id);
}
