<?php
extract($_REQUEST);
require_once './models/brandModel.php';
require_once './models/categoryModel.php';
require_once './models/productModel.php';
require_once './models/contactModel.php';
require_once './models/blogModel.php';
require_once './models/slider_banner_Model.php';
require_once './models/configModel.php';
$promotion_price = 0;
if (isset($act)) {
    switch ($act) {
        case 'search':
            $keyword = $_REQUEST['keyword'];
            $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
            $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 99999999999;
            $priceFiltersQuery = buildPriceFiltersQuery();
            $sp_search = product_search($keyword, 0, PHP_INT_MAX, $min_price, $max_price);

            if (!empty($sp_search) && isset($sp_search[0])) {
                $list_size = product_by_size($sp_search[0]['id']);
                $total = count($sp_search);
                // Phân trang nếu cần
                $page = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
                $limit = 6;
                $first = ($page - 1) * $limit;

                $sp_search = array_slice($sp_search, $first, $limit);
                $totalPages = ceil($total / $limit);
            } else {
                $list_size = 0;
            }
            foreach ($sp_search as $key => $item) {
                $size_list = product_by_size($item['id'])[0];
                $sp_search[$key]['size_list'] = $size_list;
                if ($item['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item['promotion'] / 100);
                    $sp_search[$key]['promotion_price'] = $promotion_price;
                    $sp_search[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $sp_search[$key]['old_price'] =  $size_list['temp_price'];
                    $sp_search[$key]['promotion_price'] = $promotion_price;
                }
            }
            $list_categories = category_list(0);
            $category = displayCategories($list_categories);
            $list_brand = brand_list();
            require_once 'views/product-search.php';
            break;
        case 'product':
            // Lọc sản phẩm theo khoảng giá
            $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
            $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 99999999999;

            // Sắp xếp sản phẩm
            // $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default'; // Sắp xếp mặc định
            // $validSorts = ['default', 'name_asc', 'name_desc', 'temp_price_asc', 'temp_price_desc', 'newest', 'oldest'];

            // if (!in_array($sort, $validSorts)) {
            //     $sort = 'default'; // Sắp xếp mặc định nếu giá trị sort không hợp lệ
            // }
            $priceFiltersQuery = buildPriceFiltersQuery();
            // Gọi function show sản phẩm và danh mục với các tham số lọc giá và sắp xếp
            $list_product = product_site_all(0, PHP_INT_MAX, $min_price, $max_price);

            // Kiểm tra xem mảng $list_product có tồn tại và có ít nhất một phần tử hay không
            if (!empty($list_product) && isset($list_product[0])) {
                $total = count($list_product);

                // Phân trang nếu cần
                $page = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
                $limit = 3;
                $first = ($page - 1) * $limit;

                $list_product = array_slice($list_product, $first, $limit);
                $totalPages = ceil($total / $limit);
            }
            foreach ($list_product as $key => $item) {
                $size_list = product_by_size($item['id'])[0];
                $list_product[$key]['size_list'] = $size_list;
                if ($item['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item['promotion'] / 100);
                    $list_product[$key]['promotion_price'] = $promotion_price;
                    $list_product[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $list_product[$key]['old_price'] =  $size_list['temp_price'];
                    $list_product[$key]['promotion_price'] = $promotion_price;
                }
            }
            $list_categories = category_list(0);
            $category = displayCategories($list_categories);
            $list_brand = brand_list();
            require_once 'views/product.php';
            break;
        case 'category':
            // Lọc sản phẩm theo khoảng giá
            $min_price = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
            $max_price = isset($_GET['max_price']) ? intval($_GET['max_price']) : 9999999;

            // Sắp xếp sản phẩm
            // $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default'; // Sắp xếp mặc định
            // $validSorts = ['default', 'name_asc', 'name_desc', 'price_asc', 'price_desc', 'newest', 'oldest'];

            // if (!in_array($sort, $validSorts)) {
            //     $sort = 'default'; // Sắp xếp mặc định nếu giá trị sort không hợp lệ
            // }

            // Trang hiển thị sản phẩm theo danh mục
            $page = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
            $slug = $_REQUEST['cat'];
            $limit = 3;
            $first = ($page - 1) * $limit;

            // Lấy danh sách danh mục sản phẩm.
            $list_categories = category_list(0);

            // Lấy thông tin danh mục dựa trên slug.
            $row_cat = category_rowslug($slug);

            // Lấy danh sách catid của danh mục này.
            $list_catid = category_listcatid($row_cat['id']);
            // Đếm tổng số sản phẩm thuộc danh mục.
            $total = product_category_count($list_catid);

            // Lấy danh sách sản phẩm thuộc danh mục với phân trang, lọc và sắp xếp.
            $list_product = product_category($list_catid, $min_price, $max_price);
            if (!empty($list_product) && isset($list_product[0])) {
                $total = count($list_product);

                // Phân trang nếu cần
                $page = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
                $limit = 3;
                $first = ($page - 1) * $limit;

                $list_product = array_slice($list_product, $first, $limit);
                $totalPages = ceil($total / $limit);
            }
            foreach ($list_product as $key => $item) {
                $size_list = product_by_size($item['id'])[0];
                $list_product[$key]['size_list'] = $size_list;
                if ($item['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item['promotion'] / 100);
                    $list_product[$key]['promotion_price'] = $promotion_price;
                    $list_product[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $list_product[$key]['old_price'] =  $size_list['temp_price'];
                    $list_product[$key]['promotion_price'] = $promotion_price;
                }
            }

            $list_slider = slider_all($slug);
            $category = displayCategories($list_categories);
            $list_brand = brand_list();
            require_once 'views/product-category.php';
            break;
        case 'add-wishlist':
            $user_id = $_SESSION['user']['id'];
            $product_id = $_REQUEST['pid'];
            if (!isset($_SESSION['user'])) {
                // Nếu không có session user, chuyển hướng đến trang đăng nhập và lưu lại trang trước đó
                $_SESSION['redirect_url'] = $referer;
                header("Location: index.php?option=user&act=login");
                exit();
            }
            $result = wishlist_insert($product_id, $user_id);
            if ($result) {
                set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Thêm sản phẩm yêu thích thành công!']);
            } else {
                set_flash('message', ['type' => 'warning', 'title' => 'Thao tác thất bại', 'msg' => 'Thêm sản phẩm yêu thích không thành công!']);
            }
            header('location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        case 'wishlist':
            $itemsPerPage = 10; // Số lượng sản phẩm trên mỗi trang
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            $list_wishlist = list_wishlist($_SESSION['user']['id'], $currentPage, $itemsPerPage);

            // Lấy tổng số sản phẩm trong danh sách yêu thích
            $totalItems = count_wishlist_items($_SESSION['user']['id']);

            $totalPages = ceil($totalItems / $itemsPerPage);
            foreach ($list_wishlist as $key => $item) {
                $product = product_rowid($item['product_id']);
                $size_list = product_by_size($item['product_id'])[0];

                $list_wishlist[$key]['product'] = $product;
                $list_wishlist[$key]['size_list'] = $size_list;

                if ($product['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $product['promotion'] / 100);
                    $list_wishlist[$key]['promotion_price'] = $promotion_price;
                    $list_wishlist[$key]['old_price'] = $size_list['temp_price'];
                } else {
                    $list_wishlist[$key]['old_price'] = $size_list['temp_price'];
                    $list_wishlist[$key]['promotion_price'] = $promotion_price;
                }
            }

            require_once 'views/wishlist.php';
            break;
        case 'del-wishlist':
            $id = $_REQUEST['id'];
            $result = wishlist_delete($id);
            if ($result) {
                set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Xoá sản phẩm yêu thích thành công!']);
                header('Location: index.php?option=page&act=wishlist');
                exit();
            } else {
                set_flash('message', ['type' => 'error', 'title' => 'Thao tác thành công', 'msg' => 'Xoá sản phẩm yêu thích thất bại!']);
                header('Location: index.php?option=page&act=wishlist');
                exit();
            }

        case 'product-detail':
            //Trang chi tiết sản phẩm
            $slug = $_REQUEST['slug'];
            $row = product_rowslug($slug);
            $list_size = product_by_size($row['id']);
            $material_name = get_material_name($row['material_id']);
            $list_comment = product_list_comment($row['id']);
            product_view_increase($slug);

            $list_catid = category_listcatid($row['category_id']);
            $list_other = product_other($list_catid, $row['id']);
            require_once 'views/product-detail.php';
            break;
        case 'review':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $slug = $_POST['slug'];
                $product_id = $_POST['product_id'];
                $user_id = $_POST['user_id'];
                $fullname = $_POST['fullname'];
                $email =  $_POST['email'];
                $detail = $_POST['detail'];
                $created_at = date('Y-m-d H:i:s');
                $result = product_insert_comment($product_id, $user_id, $fullname, $email, $detail, $created_at);
                if ($result) {
                    set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Gửi bình luận thành công!']);
                } else {
                    set_flash('message', ['type' => 'warning', 'title' => 'Thao tác không thành công', 'msg' => 'Gửi bình luận thất bại!']);
                }
                // Sau khi xử lý xong, sử dụng header để quay trở lại trang trước đó
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            break;
        case 'post':
            $limit = 3; // Số lượng bài viết trên mỗi trang
            $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
            $first = ($currentPage - 1) * $limit;

            $post_all = post_site_all($first, $limit);
            $totalPosts = count_all_posts(); // Viết hàm để đếm tổng số bài viết

            $totalPages = ceil($totalPosts / $limit);

            foreach ($post_all as $key => $value) {
                $topic = topic_by_id($value['topic_id']);
            }
            $list_topic = topic_all();
            require_once 'views/post.php';
            break;
        case 'post-detail':
            $slug = $_REQUEST['slug'];
            $row = post_rowslug($slug);
            $list_topic = topic_all();
            $list_comment = post_list_comment($row['id']);
            foreach ($list_comment as $key => $value) {
                $user = customer_by_id($value['user_id']);
            }

            require_once 'views/post-detail.php';
            break;
        case 'post-comment':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $post_id = $_POST['post_id'];
                $user_id = $_POST['user_id'];
                $fullname = $_POST['fullname'];
                $email =  $_POST['email'];
                $detail = $_POST['detail'];
                $created_at = date('Y-m-d H:i:s');
                $result = post_insert_comment($post_id, $user_id, $fullname, $email, $detail, $created_at);
                if ($result) {
                    set_flash('message', ['type' => 'success', 'title' => 'Thao tác thành công', 'msg' => 'Gửi bình luận thành công!']);
                } else {
                    set_flash('message', ['type' => 'warning', 'title' => 'Thao tác không thành công', 'msg' => 'Gửi bình luận thất bại!']);
                }
                // Sau khi xử lý xong, sử dụng header để quay trở lại trang trước đó
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            break;
        case 'post-category':
            $cat = $_REQUEST['cat'];
            $topic = topic_rowslug($cat);
            $limit = 3; // Số lượng bài viết trên mỗi trang
            $currentPage = isset($_GET['pages']) ? intval($_GET['pages']) : 1;
            $first = ($currentPage - 1) * $limit;

            $post_all = post_topic_all($cat, $first, $limit);
            $totalPosts = count_posts_by_category($cat); // Viết hàm để đếm tổng số bài viết trong một danh mục

            $totalPages = ceil($totalPosts / $limit);

            foreach ($post_all as $key => $value) {
                $topic = topic_by_id($value['topic_id']);
            }
            $list_topic = topic_all();
            // Gọi view
            require_once 'views/post-category.php';
            break;

        case 'contact':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $title = $_POST['title'];
                $detail = trim($_POST['detail']);
                $status = 0; //Lưu ở trạng thái chưa trả lời
                $isDeleted = 1; //Không ở trạng thái lưu trữ
                contact_insert($fullname, $email, $phone, $title, $detail, $status, $isDeleted);
                $thongbao = "Gửi liên hệ thành công";
                redirect("?option=page&act=contact");
            }
            require_once 'views/contact.php';
            break;
        case 'home':
            $product_list_newest = product_list_home('newest');
            foreach ($product_list_newest as $key => $item_newest) {
                $size_list = product_by_size($item_newest['id'])[0];
                $product_list_newest[$key]['size_list'] = $size_list;
                if ($item_newest['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_newest['promotion'] / 100);
                    $product_list_newest[$key]['promotion_price'] = $promotion_price;
                    $product_list_newest[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $product_list_newest[$key]['old_price'] =  $size_list['temp_price'];
                    $product_list_newest[$key]['promotion_price'] = $promotion_price;
                }
            }
            $product_list_topview = product_list_home('topview');
            foreach ($product_list_topview as $key => $item_topview) {
                $size_list = product_by_size($item_topview['id'])[0];
                $product_list_topview[$key]['size_list'] = $size_list;
                if ($item_topview['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_topview['promotion'] / 100);
                    $product_list_topview[$key]['promotion_price'] = $promotion_price;
                    $product_list_topview[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $product_list_topview[$key]['old_price'] =  $size_list['temp_price'];
                    $product_list_topview[$key]['promotion_price'] = $promotion_price;
                }
            }
            $product_list_hotdeal = product_list_home('hotdeal');
            foreach ($product_list_hotdeal as $key => $item_hotdeal) {
                $size_list = product_by_size($item_hotdeal['id'])[0];
                $product_list_hotdeal[$key]['size_list'] = $size_list;
                if ($item_hotdeal['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_hotdeal['promotion'] / 100);
                    $product_list_hotdeal[$key]['promotion_price'] = $promotion_price;
                    $product_list_hotdeal[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $product_list_hotdeal[$key]['old_price'] =  $size_list['temp_price'];
                    $product_list_hotdeal[$key]['promotion_price'] = $promotion_price;
                }
            }
            $product_list_topsold = product_list_home('topsold');
            foreach ($product_list_topsold as $key => $item_topsold) {
                $size_list = product_by_size($item_topsold['id'])[0];
                $product_list_topsold[$key]['size_list'] = $size_list;
                if ($item_topsold['promotion'] > 0) {
                    $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_topsold['promotion'] / 100);
                    $product_list_topsold[$key]['promotion_price'] = $promotion_price;
                    $product_list_topsold[$key]['old_price'] =  $size_list['temp_price'];
                } else {
                    $product_list_topsold[$key]['old_price'] =  $size_list['temp_price'];
                    $product_list_topsold[$key]['promotion_price'] = $promotion_price;
                }
            }
            $list_slider = slider_all('home');
            $list_banner_slider = banner_all('slider');
            $list_blog = post_list_home();
            $list_brand = brand_list();
            require_once 'views/home.php';
            break;
    }
} else {
    $product_list_newest = product_list_home('newest');
    foreach ($product_list_newest as $key => $item_newest) {
        $size_list = product_by_size($item_newest['id'])[0];
        $product_list_newest[$key]['size_list'] = $size_list;
        if ($item_newest['promotion'] > 0) {
            $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_newest['promotion'] / 100);
            $product_list_newest[$key]['promotion_price'] = $promotion_price;
            $product_list_newest[$key]['old_price'] =  $size_list['temp_price'];
        } else {
            $product_list_newest[$key]['old_price'] =  $size_list['temp_price'];
            $product_list_newest[$key]['promotion_price'] = $promotion_price;
        }
    }
    $product_list_topview = product_list_home('topview');
    foreach ($product_list_topview as $key => $item_topview) {
        $size_list = product_by_size($item_topview['id'])[0];
        $product_list_topview[$key]['size_list'] = $size_list;
        if ($item_topview['promotion'] > 0) {
            $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_topview['promotion'] / 100);
            $product_list_topview[$key]['promotion_price'] = $promotion_price;
            $product_list_topview[$key]['old_price'] =  $size_list['temp_price'];
        } else {
            $product_list_topview[$key]['old_price'] =  $size_list['temp_price'];
            $product_list_topview[$key]['promotion_price'] = $promotion_price;
        }
    }
    $product_list_hotdeal = product_list_home('hotdeal');
    foreach ($product_list_hotdeal as $key => $item_hotdeal) {
        $size_list = product_by_size($item_hotdeal['id'])[0];
        $product_list_hotdeal[$key]['size_list'] = $size_list;
        if ($item_hotdeal['promotion'] > 0) {
            $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_hotdeal['promotion'] / 100);
            $product_list_hotdeal[$key]['promotion_price'] = $promotion_price;
            $product_list_hotdeal[$key]['old_price'] =  $size_list['temp_price'];
        } else {
            $product_list_hotdeal[$key]['old_price'] =  $size_list['temp_price'];
            $product_list_hotdeal[$key]['promotion_price'] = $promotion_price;
        }
    }
    $product_list_topsold = product_list_home('topsold');
    foreach ($product_list_topsold as $key => $item_topsold) {
        $size_list = product_by_size($item_topsold['id'])[0];
        $product_list_topsold[$key]['size_list'] = $size_list;
        if ($item_topsold['promotion'] > 0) {
            $promotion_price = $size_list['temp_price'] - ($size_list['temp_price'] * $item_topsold['promotion'] / 100);
            $product_list_topsold[$key]['promotion_price'] = $promotion_price;
            $product_list_topsold[$key]['old_price'] =  $size_list['temp_price'];
        } else {
            $product_list_topsold[$key]['old_price'] =  $size_list['temp_price'];
            $product_list_topsold[$key]['promotion_price'] = $promotion_price;
        }
    }


    $list_slider = slider_all('home');
    $list_banner_slider = banner_all('slider');
    $list_blog = post_list_home();
    $list_brand = brand_list();
    require_once 'views/home.php';
}
