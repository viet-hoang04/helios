<?php

//Show danh sách sản phẩm theo option ở trang chủ
function product_list_home($option = null)
{
    if ($option == 'newest') {
        $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.status = 1
        ORDER BY p.id DESC
        LIMIT 8";
    } elseif ($option == 'topview') {
        $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.status = 1
        ORDER BY p.view DESC
        LIMIT 8";
    } elseif ($option == 'hotdeal') {
        $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.status = 1
        ORDER BY p.promotion DESC
        LIMIT 1";
    } elseif ($option == 'topsold') {
        $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.status = 1
        ORDER BY p.sold_count DESC
        LIMIT 5";
    }
    return pdo_query_all($sql);
}
function product_category($list_catid, $first, $limit, $minPrice = 0, $maxPrice = PHP_INT_MAX)
{
    $strin = implode(',', $list_catid);
    $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.category_id IN ($strin) 
        AND p.status != 0
        AND p.price >= ? 
        AND p.price <= ? LIMIT $first,$limit";

    return pdo_query_all($sql, $minPrice, $maxPrice);
}
function product_category_count($list_catid)
{
    $strin = implode(',', $list_catid);
    $sql = "SELECT * FROM db_product WHERE category_id IN($strin) AND status =1";
    return count(pdo_query_all($sql));
}
function buildPriceFiltersQuery()
{
    $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : null;
    $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : null;

    if ($min_price !== null || $max_price !== null) {
        return "&min_price=$min_price&max_price=$max_price";
    } else {
        return '';
    }
}

//Hàm Show danh sách sản phẩm có điều kiện ở trang tất cả sản phẩm
function product_site_all($first, $limit, $minPrice = 0, $maxPrice = PHP_INT_MAX)
{
    $sql = "SELECT p.*, i.img_id, i.product_id, i.img
        FROM db_product p
        INNER JOIN (
            SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
            FROM db_product_img
            GROUP BY product_id
        ) i ON p.id = i.product_id
        WHERE p.status !=0
        AND p.price >= ? 
        AND p.price <= ? LIMIT $first,$limit";

    return pdo_query_all($sql, $minPrice, $maxPrice);
}

//Hàm tìm kiếm sản phẩm theo tên
function product_search($keyword, $first, $limit, $minPrice = 0, $maxPrice = PHP_INT_MAX)
{
    $sql = "SELECT p.*, i.img_id, i.product_id, i.img
    FROM db_product p
    INNER JOIN (
        SELECT MIN(id) AS img_id, product_id, MIN(image) AS img
        FROM db_product_img
        GROUP BY product_id
    ) i ON p.id = i.product_id
    WHERE p.status!=0 
    AND p.name LIKE '%$keyword%'
    AND p.price >= ? 
    AND p.price <= ? LIMIT $first,$limit";
    return pdo_query_all($sql, $minPrice, $maxPrice);
}

//Các Function ở trang chi tiết sản phẩm
function product_rowslug($slug)
{
    $sql = "SELECT p.*, i.image AS product_img
        FROM db_product AS p
        LEFT JOIN db_product_img AS i ON p.id = i.product_id
        WHERE p.slug=?";
    $product = pdo_query_one($sql, $slug);

    // Lấy tất cả hình ảnh có cùng productid từ bảng db_product_img
    $sqlImg = "SELECT image FROM db_product_img WHERE product_id = ?";
    $productImages = pdo_query_all($sqlImg, $product['id']);

    // Tạo một mảng chứa đường dẫn đến hình ảnh
    $imagePaths = array();
    foreach ($productImages as $img) {
        $imagePaths[] = $img['image'];
    }

    // Thêm mảng hình ảnh vào kết quả trả về
    $product['more_images'] = $imagePaths;

    return $product;
}

function product_by_size($product_id)
{
    $sql = "SELECT db_product_size.*, db_size.name_size
            FROM db_product_size
            JOIN db_size ON db_size.id = db_product_size.size_id
            WHERE db_product_size.product_id = ?";
    return pdo_query_all($sql, $product_id);
}
function get_material_name($id)
{
    $sql = "SELECT * FROM db_material WHERE id=?";
    $result = pdo_query_one($sql, $id);
    return $result['name'];
}

function product_rowid($id)
{
    $sql = "SELECT p.*, i.image AS product_img
        FROM db_product AS p
        LEFT JOIN db_product_img AS i ON p.id = i.product_id
        WHERE p.id=?";
    $product = pdo_query_one($sql, $id);

    // Lấy tất cả hình ảnh có cùng productid từ bảng db_product_img
    $sqlImg = "SELECT image FROM db_product_img WHERE product_id = ?";
    $productImages = pdo_query_all($sqlImg, $product['id']);

    // Tạo một mảng chứa đường dẫn đến hình ảnh
    $imagePaths = array();
    foreach ($productImages as $img) {
        $imagePaths[] = $img['image'];
    }

    // Thêm mảng hình ảnh vào kết quả trả về
    $product['more_images'] = $imagePaths;

    return $product;
}
//Hàm tăng lượt view khi nhấp vào link sản phẩm
function product_view_increase($id)
{
    $sql = "UPDATE db_product SET view = view + 1 WHERE slug=?";
    pdo_execute($sql, $id);
}
//Hàm lấy ra danh sách sản phẩm cùng danh mục dựa theo category_id
function product_other($list_catid, $id)
{
    $strin = implode(',', $list_catid);
    $sql = "SELECT p.*, i.image
            FROM db_product p
            LEFT JOIN (
                SELECT product_id, MIN(id) AS min_img_id
                FROM db_product_img
                GROUP BY product_id
            ) AS min_img
            ON p.id = min_img.product_id
            LEFT JOIN db_product_img i
            ON min_img.min_img_id = i.id
            WHERE p.category_id IN ($strin) AND p.id != '$id' AND p.status !=0
            ORDER BY p.id DESC";
    return pdo_query_all($sql);
}
//Bình luận sản phẩm
function product_insert_comment($product_id, $user_id, $fullname, $email, $detail, $created_at)
{
    $sql = "INSERT INTO db_product_comment (product_id,user_id,fullname,email,detail,created_at) VALUES (?,?,?,?,?,?)";
    return pdo_execute($sql, $product_id, $user_id, $fullname, $email, $detail, $created_at);
}
function product_list_comment($product_id)
{
    $sql = "SELECT * FROM db_product_comment WHERE product_id=? ORDER BY id DESC LIMIT 5";
    return pdo_query_all($sql, $product_id);
}

//Thêm sản phẩm vào yêu thích
function wishlist_insert($product_id, $user_id)
{
    $sql = "INSERT INTO db_wishlist (product_id,customer_id) VALUES(?,?)";
    $result = pdo_execute($sql, $product_id, $user_id);
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function list_wishlist($user_id, $page = 1, $itemsPerPage = 10)
{
    $offset = ($page - 1) * $itemsPerPage;
    $sql = "SELECT * FROM db_wishlist WHERE customer_id=? LIMIT $offset, $itemsPerPage";
    return pdo_query_all($sql, $user_id);
}

function count_wishlist_items($user_id)
{
    $sql = "SELECT COUNT(*) as count FROM db_wishlist WHERE customer_id=?";
    $result = pdo_query_one($sql, $user_id);
    return $result['count'];
}

function wishlist_delete($id)
{
    $sql = "DELETE FROM db_wishlist WHERE id=?";
    return pdo_execute($sql, $id);
}
