<?php
if (!isset($_SESSION)) {
    session_start();
}
ob_start();
extract($_REQUEST);
require_once '../system/Database.php';
require_once '../system/myFunction.php';
require_once '../system/Global.php';
require_once '../system/auth.php';
if (!isset($_SESSION['user'])) {
    require_once 'controllers/authController.php';
    exit;
} elseif ($_SESSION['user']['role'] == 'customer') {
    header('location: ../site/index.php?option=page&act=home');
    exit;
} else {
    require_once 'views/header.php';
    if (isset($option)) {
        switch ($option) {
            case 'category':
                require_once 'controllers/categoryController.php';
                break;
            case 'brand':
                require_once 'controllers/brandController.php';
                break;
            case 'product':
                require_once 'controllers/productController.php';
                break;
            case 'size':
                require_once 'controllers/sizeController.php';
                break;
            case 'material':
                require_once 'controllers/materialController.php';
                break;
            case 'user':
                require_once 'controllers/userController.php';
                break;
            case 'customer':
                require_once 'controllers/customerController.php';
                break;
            case 'rank':
                require_once 'controllers/rankController.php';
                break;
            case 'menu':
                require_once 'controllers/menuController.php';
                break;
            case 'slider':
                require_once 'controllers/sliderController.php';
                break;
            case 'banner':
                require_once 'controllers/bannerController.php';
                break;
            case 'topic':
                require_once 'controllers/topicController.php';
                break;
            case 'post':
                require_once 'controllers/postController.php';
                break;
            case 'single_page':
                require_once 'controllers/singlepageController.php';
                break;
            case 'order':
                require_once 'controllers/orderController.php';
                break;
            case 'contact':
                require_once 'controllers/contactController.php';
                break;
            case 'config':
                require_once 'controllers/configController.php';
                break;
            default:
                require_once 'controllers/dashboardController.php';
                break;
        }
    } else {
        require_once 'controllers/dashboardController.php';
    }
    require_once 'views/footer.php';
    require_once 'views/modules/message.php';
}
