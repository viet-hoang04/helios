<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="jtv-hot-deal-product">
            <div class="jtv-new-title">
                <h2 class="text-center">Hot deal</h2>
            </div>
            <ul class="products-grid">
                <?php foreach ($product_list_hotdeal as $item_hotdeal) : ?>
                    <li class="right-space two-height item">
                        <div class="item-inner">
                            <div class="item-img">
                                <div class="item-img-info">
                                    <a href="index.php?option=page&act=product-detail&slug=<?= $item_hotdeal['slug'] ?>" title="<?= $item_hotdeal['name'] ?> " class="product-image">
                                        <img src="../public/images/product/<?= $item_hotdeal['img'] ?>" alt="<?= $item_hotdeal['name'] ?> ">
                                    </a>
                                    <div class="hot-label hot-top-left">Hot Deal</div>
                                    <div class="sale-label sale-top-right"><?= $item_hotdeal['promotion'] ?>%</div>
                                </div>
                            </div>

                            <div class="item-info">
                                <div class="info-inner">
                                    <div class="item-title">
                                        <a title="<?= $item_hotdeal['name'] ?>" href="index.php?option=page&act=product-detail&slug=<?= $item_hotdeal['slug'] ?>"><?= $item_hotdeal['name'] ?> </a>
                                    </div>
                                    <div class="item-content">
                                        <div class="item-price">
                                            <?php if ($item_hotdeal['promotion'] > 0) : ?>
                                                <span class="regular-price" id="displayedPrice">
                                                    <span class="price">
                                                        <?= number_format($item_hotdeal['promotion_price']) ?> Vnđ
                                                    </span>
                                                </span>
                                                <p class="old-price">
                                                    <span class="price-label">Giá gốc:</span>
                                                    <span class="price"><?= number_format($item_hotdeal['old_price']) ?> Vnđ </span>
                                                </p>
                                            <?php else : ?>
                                                <span class="regular-price">
                                                    <span class="price">
                                                        <?= number_format($item_hotdeal['old_price']) ?> Vnđ
                                                    </span>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <div class="add_cart">
                                            <button class="button btn-cart" type="button">
                                                <span>
                                                    <a href="index.php?option=cart&act=add-cart&pid=<?= $item['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                        <div class="mask-right-shop">
                                                            <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                                        </div>
                                                    </a>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12 hidden-sm">
        <div class="sidebar-banner">
            <div class="jtv-top-banner"> <a href="#"> <img src="../public/images/banner3.jpg" alt="banner"> </a> </div>
            <div class="jtv-top-banner"> <a href="index.php?option=page&act=product"> <img src="../public/images/banner4.jpg" alt="banner"> </a></div>
        </div>
    </div>
    <!-- Top Seller Slider -->
    <div class="col-sm-4 col-xs-12">
        <div class="jtv-top-products">
            <div class="slider-items-products">
                <div class="jtv-new-title">
                    <h2>Top Seller</h2>
                </div>
                <div id="top-products-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 products-grid">
                        <?php foreach ($product_list_topsold as $item_topsold) : ?>
                            <div class="item">
                                <div class="item-inner">
                                    <div class="item-img">
                                        <div class="item-img-info">
                                            <a href="index.php?option=page&act=product-detail&slug=<?= $item_topsold['slug'] ?>" title="<?= $item_topsold['name'] ?> " class="product-image">
                                                <img src="../public/images/product/<?= $item_topsold['img'] ?>" alt="<?= $item_topsold['name'] ?> ">
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-info">
                                        <div class="info-inner">
                                            <div class="item-title">
                                                <a title="<?= $item_topsold['name'] ?>" href="index.php?option=page&act=product-detail&slug=<?= $item_topsold['slug'] ?>"><?= $item_topsold['name'] ?> </a>
                                            </div>
                                            <div class="item-content">
                                                <div class="item-price">
                                                    <?php if ($item_topsold['promotion'] > 0) : ?>
                                                        <span class="regular-price" id="displayedPrice">
                                                            <span class="price">
                                                                <?= number_format($item_topsold['promotion_price']) ?> Vnđ
                                                            </span>
                                                        </span>
                                                        <p class="old-price">
                                                            <span class="price-label">Giá gốc:</span>
                                                            <span class="price"><?= number_format($item_topsold['old_price']) ?> Vnđ </span>
                                                        </p>
                                                    <?php else : ?>
                                                        <span class="regular-price">
                                                            <span class="price">
                                                                <?= number_format($item_topsold['old_price']) ?> Vnđ
                                                            </span>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <div class="add_cart">
                                                    <button class="button btn-cart" type="button">
                                                        <span>
                                                            <a href="index.php?option=cart&act=add-cart&pid=<?= $item['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                                <div class="mask-right-shop">
                                                                    <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                                                </div>
                                                            </a>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Seller Slider -->
    </div>
</div>