<?php
extract($_REQUEST);
require_once './models/statisticModel.php';
$path = 'views/pages/dashboard/';
if (isset($act)) {
    switch ($act) {
        default:
            $product_by_category = statistic_product_by_category();
            $category_status = statistic_category();
            $order_statitic = statistic_order_by_stage();
            
            $count_product = product_all_count();
            $count_post = post_all_count();
            $count_user = user_all_count();
            $count_order = order_all_count();
            require_once $path . 'index.php';
            break;
    }
} else {
    $product_by_category = statistic_product_by_category();
    $category_status = statistic_category();
    $order_statitic = statistic_order_by_stage();

    $count_product = product_all_count();
    $count_post = post_all_count();
    $count_user = user_all_count();
    $count_order = order_all_count();
    require_once $path . 'index.php';
}
