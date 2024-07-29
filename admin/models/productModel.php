<?php
//Lấy danh sách thương hiệu cho 2 trang là index, trash.
//Có thể kết hợp những trang khác như insert,update
function product_all($page = 'index')
{
    if ($page == 'index') {
        $sql = "SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM db_product p
        JOIN db_category c ON p.category_id = c.id
        JOIN db_brand b ON p.brand_id = b.id
        WHERE p.status != 0
        GROUP BY p.id
        ORDER BY p.id ASC";
    } else {
        $sql = "SELECT p.*, c.name AS category_name, b.name AS brand_name
        FROM db_product p
        JOIN db_category c ON p.category_id = c.id
        JOIN db_brand b ON p.brand_id = b.id
        WHERE p.status = 0
        GROUP BY p.id
        ORDER BY p.id ASC";
    }
    return pdo_query_all($sql);
}


//Lấy ra sản phẩm mới nhất dựa theo id cuối cùng được thêm
function product_lastid()
{
    $sql = "SELECT * FROM db_product ORDER BY id DESC LIMIT 1";
    $result = pdo_query_one($sql);
    return $result['id'];
}
//Lấy ra thông tin thương hiệu dựa theo id hoặc slug
function product_rowid($id)
{
    $sql = "SELECT * FROM db_product WHERE id = ?";
    return pdo_query_one($sql, $id);
}
function product_rowslug($slug)
{
    $sql = "SELECT * FROM db_product WHERE slug = ?";
    return pdo_query_one($sql, $slug);
}
//Kiểm tra xem tên product có tồn tại hay chưa dựa trên slug
function product_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_product WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_product WHERE slug=? AND id!=?";
        return pdo_query_one($sql, $slug, $id);
    }
}

function category_has_products($id)
{
    $sql = "SELECT COUNT(*) FROM db_product WHERE category_id = ?";
    $count = pdo_query_value($sql, $id);
    return $count > 0;
}
function product_generate_sku($brand_id, $category_id, $product_name, $product_id)
{
    $productNameCode = strtoupper(substr($product_name, 0, 3));
    $sku = $brand_id . $category_id . $productNameCode . $product_id;
    return $sku;
}
//Kiểm tra xem product có tồn tại sản phẩm không dựa theo product_id của bảng product
//Thêm sản phẩm
function product_insert($category_id, $brand_id, $name, $slug, $smdetail, $detail, $material_id, $quantity, $price, $promotion, $status)
{
    // $size = implode(', ', $size);
    $sql = "INSERT INTO db_product (category_id,brand_id,name,slug,smdetail,detail,material_id,quantity,price,promotion,status, SKU) VALUE (?,?,?,?,?,?,?,?,?,?,?,?)";
    // Tính toán giá trị cho SKU
    $brand_name = brand_name_id($brand_id);
    $category_name = category_name_id($category_id);

    pdo_execute($sql, $category_id, $brand_id, $name, $slug, $smdetail, $detail, $material_id, $quantity, $price, $promotion, $status, '');
    // Lấy ID của sản phẩm vừa thêm
    $product_id = product_lastid();

    // Tính toán giá trị SKU mới
    $sku = generate_sku($brand_name, $category_name, $slug, $product_id);

    // Cập nhật SKU cho sản phẩm với ID vừa lấy
    $sql_update_sku = "UPDATE db_product SET SKU = ? WHERE id = ?";
    pdo_execute($sql_update_sku, $sku, $product_id);
}
function generate_sku($brand_name, $category_name, $product_name, $product_id)
{
    // Tạo logic để tạo SKU dựa trên tên danh mục, tên sản phẩm và ID sản phẩm
    // Ví dụ: Nếu danh mục là 'Vòng Cổ' và tên sản phẩm là 'Vòng cổ bạc có đính đá', thì SKU sẽ là 'TCV001-SIL'
    $brand_code = strtoupper(substr($brand_name, 0, 3));
    $category_code = strtoupper(substr($category_name, 0, 3)); // Lấy 3 ký tự đầu của tên danh mục và chuyển thành chữ in hoa
    $product_code = strtoupper(substr($product_name, 0, 3)); // Lấy 3 ký tự đầu của tên sản phẩm và chuyển thành chữ in hoa
    $sku = $brand_code . $category_code . str_pad($product_id, 3, '0', STR_PAD_LEFT) . '-' . $product_code;

    return $sku;
}

//Cập nhật thông tin sản phẩm
function product_update($category_id, $brand_id, $name, $slug, $smdetail, $detail, $material_id, $quantity, $price, $promotion, $status, $id)
{
    // $size = implode(',', $size);
    // Cập nhật thông tin sản phẩm
    $update_sql = "UPDATE db_product SET category_id=?,brand_id=?,name=?,slug=?,smdetail=?,detail=?,material_id=?,quantity=?,price=?,promotion=?,status=? WHERE id=?";
    $success = pdo_execute($update_sql, $category_id, $brand_id, $name, $slug, $smdetail, $detail, $material_id, $quantity, $price, $promotion, $status, $id);

    if ($success) {
        // Lấy thông tin sản phẩm sau khi cập nhật
        $updated_product = product_rowid($id);
        $brand_name = brand_name_id($updated_product['brand_id']);
        $category_name = category_name_id($updated_product['category_id']);
        // Tạo SKU mới dựa trên thông tin cập nhật
        $product_name = $updated_product['slug'];
        $product_id = $id;

        $sku = generate_sku($brand_name, $category_name, $product_name, $product_id);

        // Cập nhật SKU vào bảng db_product
        $update_sku_sql = "UPDATE db_product SET sku=? WHERE id=?";
        pdo_execute($update_sku_sql, $sku, $id);
    }
}

//Cập nhật trạng thái sản phẩm
function product_update_status($status, $id)
{
    $sql = "UPDATE db_product SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
//Xoá thương hiệu
function product_delete($id)
{
    $sql = "DELETE FROM db_product WHERE id=?";
    return pdo_execute($sql, $id);
}
