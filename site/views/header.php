<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
    <!-- <meta name="description" content="Fabulous is a creative, clean, fully responsive, powerful and multipurpose HTML Template with latest website trends. Perfect to all type of fashion stores.">
    <meta name="keywords" content="HTML,CSS,womens clothes,fashion,mens fashion,fashion show,fashion week">
    <meta name="author" content="JTV"> -->
    <!-- <title>Helios E-Commerece Jewelry Website</title> -->
    <title><?=$config['title']?></title>

    <!-- Favicons Icon -->
    <link rel="icon" href="../public/images/<?=$config['icon']?>" type="image/x-icon" />

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS Style -->
    <!-- DataTables -->
    <link rel="stylesheet" href="../public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
    <link rel="stylesheet" type="text/css" href="../public/css/styles.css" media="all">

</head>

<body class="cms-index-index cms-home-page">

    <!-- Mobile Menu -->
    <?php require_once 'modules/mobile_menu.php' ?>
    <div id="page">
        <!-- Header -->
        <header>
            <div class="header-container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-3 col-xs-12">
                            <div class="logo">
                                <a title="<?=$config['title']?>" href="index.php">
                                    <img alt="<?=$config['title']?>" src="../public/images/<?=$config['logo']?>" style="position:absolute;top:10px;left:-5px">
                                </a>
                            </div>
                            <div class="nav-icon" style="margin-top:40px">
                                <?php require_once 'modules/mega_menu.php' ?>
                            </div>
                        </div>
                        <div class="col-lg-9 col-sm-9 col-xs-12 jtv-rhs-header">
                            <div class="jtv-mob-toggle-wrap">
                                <div class="mm-toggle"><i class="fa fa-reorder"></i><span class="mm-label">Menu</span></div>
                            </div>
                            <div class="jtv-header-box">
                                <div class="search_cart_block">
                                    <div class="search-box hidden-xs">
                                        <form id="search_mini_form" action="?option=page&act=search" method="post">
                                            <input id="search" type="text" name="keyword" class="searchbox" placeholder="Nhập từ khoá tìm kiếm...." maxlength="128">
                                            <button type="submit" title="Search" class="search-btn-bg" id="submit-button"><span class="hidden-sm">Tìm kiếm</span>
                                                <i class="fa fa-search hidden-xs hidden-lg hidden-md"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="right_menu">
                                        <div class="menu_top">
                                            <div class="top-cart-contain pull-right">
                                                <div class="mini-cart">
                                                    <div class="basket">
                                                        <a class="basket-icon" href="index.php?option=cart">
                                                            <i class="fa fa-shopping-basket"></i> Giỏ hàng
                                                            <span>
                                                                <?= $cart_count; ?>
                                                            </span>
                                                        </a>
                                                        <div class="top-cart-content">
                                                            <div class="block-subtitle">
                                                                <div class="top-subtotal">
                                                                    <?= $cart_count_product; ?> sản phẩm,
                                                                    <span class="price"><?= number_format($total_price) ?> Vnđ</span>
                                                                </div>
                                                            </div>
                                                            <ul class="mini-products-list" id="cart-sidebar">
                                                                <?php if ($cart_count > 0) : ?>
                                                                    <?php foreach ($list as $item_cart) : ?>
                                                                        <li class="item">
                                                                            <div class="item-inner">
                                                                                <a class="product-image" title="<?= $item_cart['name'] ?>" href="?option=page&act=product-detail&slug=<?= $item_cart['slug'] ?>">
                                                                                    <img alt="<?= $item_cart['name'] ?>" src="../public/images/product/<?= $item_cart['img'] ?>">
                                                                                </a>
                                                                                <div class="product-details">
                                                                                    <div class="access">
                                                                                        <form action="?option=cart&act=cart-delete&pid=<?= $item_cart['id'] ?>" method="post">
                                                                                            <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                                                                                            <button type="submit" title="Xoá sản phẩm này" class="btn-remove1" style="border:none;">
                                                                                                <span>Xoá</span>
                                                                                            </button>

                                                                                        </form>
                                                                                    </div>
                                                                                    <p class="product-name">
                                                                                        <a href="?option=page&act=product-detail&slug=<?= $item_cart['slug'] ?>">
                                                                                            <?= $item_cart['name'] ?>
                                                                                        </a>
                                                                                    </p>
                                                                                    <strong><?= $item_cart['qty'] ?></strong> x <span class="price"><?= number_format($item_cart['price']) ?> Vnđ</span>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <li class="item">
                                                                        <p class="text-center">Chưa có sản phẩm trong giỏ hàng</p>
                                                                    </li>
                                                                <?php endif; ?>
                                                            </ul>
                                                            <div class="actions">
                                                                <a href="?option=cart&act=cart-view" class="view-cart"><span>Giỏ hàng</span></a>
                                                                <button onclick="window.location.href='?option=cart&act=cart-checkout'" class="btn-checkout" title="Checkout" type="button"><span>Thanh toán</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="language-box hidden-xs">
                                            <select class="selectpicker" data-width="fit">
                                                <option>English</option>
                                                <option>Francais</option>
                                                <option>German</option>
                                                <option>Español</option>
                                            </select>
                                        </div>
                                        <div class="currency-box hidden-xs">
                                            <form class="form-inline">
                                                <div class="input-group">
                                                    <div class="currency-addon">
                                                        <select class="currency-selector">
                                                            <option data-symbol="$">USD</option>
                                                            <option data-symbol="€">EUR</option>
                                                            <option data-symbol="£">GBP</option>
                                                            <option data-symbol="¥">JPY</option>
                                                            <option data-symbol="$">CAD</option>
                                                            <option data-symbol="$">AUD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="top_section hidden-xs">
                                    <div class="toplinks">
                                        <?php require_once 'modules/top_menu.php' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
        </header>
        <!-- end header -->