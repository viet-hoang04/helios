<?php
function db_connect()
{
    $dburl = "mysql:host=localhost;dbname=db_helios;charset=utf8";
    $username = 'root';
    $password = '';
    try {
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        // Xử lý lỗi kết nối cơ sở dữ liệu ở đây (ví dụ: log lỗi, hiển thị thông báo...)
        die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
    }
}
function pdo_query_all($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = db_connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        echo "Lỗi truy vấn SQL: " . $e->getMessage();
    } finally {
        unset($conn);
    }
}
function pdo_query_one($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = db_connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        echo "Lỗi truy vấn SQL: " . $e->getMessage();
    } finally {
        unset($conn);
    }
}

function pdo_query_value($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = db_connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    } catch (PDOException $e) {
        echo "Lỗi truy vấn SQL: " . $e->getMessage();
    } finally {
        unset($conn);
    }
}
function pdo_execute($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = db_connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $stmt->rowCount();  // Trả về số dòng ảnh hưởng bởi truy vấn
    } catch (PDOException $e) {
        echo "Lỗi truy vấn SQL: " . $e->getMessage();
        return false;  // Trả về giá trị để xử lý lỗi nếu cần thiết
    } finally {
        unset($conn);
    }
}
