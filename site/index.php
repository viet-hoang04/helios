<?php
extract($_REQUEST);
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
require_once '../system/Database.php';
require_once '../system/myFunction.php';
require_once '../system/form_control.php';
require_once '../system/auth.php';
require_once 'models/cartModel.php';
require_once 'models/configModel.php';
if (isset($_SESSION['cart'])) {
    $cart_count = cart_total();
    $cart_count_product = cart_total_product();
    $total_price = cart_total_price();
    $list = cart_content();
} else {
    $cart_count = 0;
    $cart_count_product = 0;
    $total_price = 0;
    // $cart_content = array();
}
$config = load_config();
extract($config);
$header_menu = load_menu('headermenu');
$parent_menu = menu_list_parentid(0,'megamenu');
foreach ($parent_menu as $key => $parent) {
    $list_menu1 = menu_list_parentid($parent['id'],'megamenu');
    $parent_menu[$key]['submenu'] = $list_menu1;

    // Thêm cấp con thứ hai
    foreach ($list_menu1 as $menu1_key => $menu1) {
        $list_menu2 = menu_list_parentid($menu1['id'],'megamenu');
        $parent_menu[$key]['submenu'][$menu1_key]['submenu'] = $list_menu2;
    }
}




$footer_menu = load_menu('footermenu',2);
foreach ($footer_menu as $key => $footer) {
    $list_footer1 = menu_list_parentid($footer['id'],'footermenu');
    $footer_menu[$key]['submenu'] = $list_footer1;
}
require_once 'views/header.php';
if (isset($option)) {
    switch ($option) {
        case 'page':
            require_once 'controllers/pageController.php';
            break;
        case 'cart':
            require_once 'controllers/cartController.php';
            break;
        case 'user':
            require_once 'controllers/userController.php';
            break;
    }
} else {
    header('location: ?option=page&act=home');
}
require_once 'views/footer.php';
// "tet";