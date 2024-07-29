<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a href="index.php" title="Go to Home Page">Home</a> <span>/</span></li>
                    <li> <strong>Giỏ hàng </strong> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<section class="main-container col1-layout">
    <div class="main container">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="product-area">
                    <div class="content-tab-product-category">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="cart">
                                <!-- cart are start-->
                                <form action="index.php?option=cart&act=cart-update" method="post">
                                    <div class="cart-page-area">
                                        <?php if ($list != NULL) : ?>
                                            <div class="table-responsive">
                                                <table class="shop-cart-table">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">Hình ảnh</th>
                                                            <th class="product-name ">Thông tin sản phẩm</th>
                                                            <th class="product-price ">Giá tiền</th>
                                                            <th class="product-quantity">Số lượng</th>
                                                            <th class="product-subtotal ">Tổng tiền</th>
                                                            <th class="product-remove">Xoá</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $total = 0; ?>
                                                        <?php foreach ($list as $item_cart) : ?>
                                                            <?php
                                                            $sub_total = $item_cart['qty'] * $item_cart['price'];
                                                            $total += $sub_total;
                                                            ?>
                                                            <tr class="cart_item">
                                                                <input type="hidden" name="pid[]" value="<?= $item_cart['id'] ?>">
                                                                <td class="item-img">
                                                                    <a href="?option=page&act=product-detail&slug=<?= $item_cart['slug'] ?>">
                                                                        <img src="../public/images/product/<?= $item_cart['img'] ?>" alt="<?= $item_cart['name'] ?>">
                                                                    </a>
                                                                </td>
                                                                <td class="item-title">
                                                                    <a href="?option=page&act=product-detail&slug=<?= $item_cart['slug'] ?>">
                                                                        <?= $item_cart['name'] ?>
                                                                    </a> <br>
                                                                    <?php if ($item_cart['material'] !== null) : ?>
                                                                        Chất liệu: <?= $item_cart['material'] ?><br>
                                                                    <?php endif; ?>
                                                                    <?php if ($item_cart['size'] !== null) : ?>
                                                                        Kích cỡ: <?= $item_cart['size'] ?><br>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td class="item-price">
                                                                    <?= number_format($item_cart['price']) ?>
                                                                </td>
                                                                <td class="item-qty">
                                                                    <div class="cart-quantity">
                                                                        <div class="product-qty">
                                                                            <div class="cart-quantity">
                                                                                <div class="cart-plus-minus">
                                                                                    <button onClick="var result = document.getElementById('qty<?= $item_cart['id'] ?>_<?= $item_cart['size'] ?>'); var qty = parseInt(result.value); if (!isNaN(qty) && qty > 1) result.value = qty - 1;" class="dec qtybutton" type="button">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </button>
                                                                                    <input type="text" class="cart-plus-minus-box" title="Qty" value="<?= $item_cart['qty'] ?>" maxlength="12" id="qty<?= $item_cart['id'] ?>_<?= $item_cart['size'] ?>" name="qty[]" readonly>
                                                                                    <button onClick="var result = document.getElementById('qty<?= $item_cart['id'] ?>_<?= $item_cart['size'] ?>'); var qty = parseInt(result.value); if (!isNaN(qty)) result.value = qty + 1;" class="inc qtybutton" type="button">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="total-price">
                                                                    <strong>
                                                                        <?php echo number_format($sub_total); ?>
                                                                    </strong>
                                                                </td>
                                                                <td class="remove-item">
                                                                    <a href="index.php?option=cart&act=cart-delete&pid=<?= $item_cart['id'] ?>">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="cart-bottom-area">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-7 col-xs-12">
                                                        <div class="update-coupne-area">
                                                            <div class="update-continue-btn text-right">
                                                                <button class="button btn-default" title="Tiếp tục mua hàng" name="continue_shop_action">
                                                                    <span><a href="index.php?option=page&act=product">Tiếp tục mua hàng</a></span>
                                                                </button>
                                                                <button class="button btn-update" title="Cập nhật giỏ hàng" value="update_qty" name="update_cart_action" type="submit">
                                                                    <span>Cập nhật giỏ hàng</span>
                                                                </button>
                                                                <button class="button btn-empty" title="Xoá giỏ hàng" value="empty_cart" name="clear_cart_action">
                                                                    <span><a href="index.php?option=cart&act=cart-delete">Xoá giỏ hàng</a></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-5 col-xs-12">
                                                        <div class="cart-total-area">
                                                            <div class="catagory-title cat-tit-5 text-right">
                                                                <h3>Tạm tính</h3>
                                                            </div>
                                                            <div class="process-cart-total">
                                                                <p>Tổng tiền <span><?= number_format($total) ?> Vnđ</span></p>
                                                            </div>
                                                            <div class="process-checkout-btn text-right">
                                                                <button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button" onclick="window.location.href='?option=cart&act=cart-checkout';"><span>Thanh toán</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <h4>
                                                Chưa có sản phẩm trong giỏ hàng. Quay lại mua hàng nhé!
                                            </h4>
                                        <?php endif; ?>
                                    </div>
                                </form>
                                <!-- cart are end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <div class="container">
    <div class="jtv-crosssel-pro">
        <div class="jtv-new-title">
            <h2>you may be interested</h2>
        </div>
        <div class="category-products">
            <ul class="products-grid">
                <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info"><a class="product-image" title="Product tilte is here" href="#"> <img alt="Product tilte is here" src="images/products/product-fashion-1.jpg"> </a>
                                <div class="new-label new-top-left">new</div>
                                <div class="sale-label sale-top-right">sale</div>
                                <div class="mask-shop-white"></div>
                                <div class="new-label new-top-left">new</div>
                                <a class="quickview-btn" href="quick-view.html"><span>Quick View</span></a> <a href="wishlist.html">
                                    <div class="mask-left-shop"><i class="fa fa-heart"></i></div>
                                </a> <a href="compare.html">
                                    <div class="mask-right-shop"><i class="fa fa-signal"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title"> <a title="Product tilte is here" href="#">Product tilte is here </a> </div>
                                <div class="item-content">
                                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                                    <div class="item-price">
                                        <div class="price-box"> <span class="regular-price"> <span class="price">$75.00</span></span></div>
                                    </div>
                                    <div class="actions"><a href="#" class="link-wishlist" title="Add to Wishlist"></a>
                                        <div class="add_cart">
                                            <button class="button btn-cart" type="button"><span>Add to Cart</span></button>
                                        </div>
                                        <a href="#" class="link-compare" title="Add to Compare"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info"><a class="product-image" title="Product tilte is here" href="#"> <img alt="Product tilte is here" src="images/products/product-fashion-1.jpg"> </a>
                                <div class="mask-shop-white"></div>
                                <div class="new-label new-top-left">new</div>
                                <a class="quickview-btn" href="quick-view.html"><span>Quick View</span></a> <a href="wishlist.html">
                                    <div class="mask-left-shop"><i class="fa fa-heart"></i></div>
                                </a> <a href="compare.html">
                                    <div class="mask-right-shop"><i class="fa fa-signal"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title"> <a title="Product tilte is here" href="#">Product tilte is here </a> </div>
                                <div class="item-content">
                                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                                    <div class="item-price">
                                        <div class="price-box"> <span class="regular-price"> <span class="price">$88.99</span></span></div>
                                    </div>
                                    <div class="actions"><a href="#" class="link-wishlist" title="Add to Wishlist"></a>
                                        <div class="add_cart">
                                            <button class="button btn-cart" type="button"><span>Add to Cart</span></button>
                                        </div>
                                        <a href="#" class="link-compare" title="Add to Compare"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info"><a class="product-image" title="Product tilte is here" href="#"> <img alt="Product tilte is here" src="images/products/product-fashion-1.jpg"> </a>
                                <div class="mask-shop-white"></div>
                                <div class="new-label new-top-left">new</div>
                                <a class="quickview-btn" href="quick-view.html"><span>Quick View</span></a> <a href="wishlist.html">
                                    <div class="mask-left-shop"><i class="fa fa-heart"></i></div>
                                </a> <a href="compare.html">
                                    <div class="mask-right-shop"><i class="fa fa-signal"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title"> <a title="Product tilte is here" href="#">Product tilte is here </a> </div>
                                <div class="item-content">
                                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                                    <div class="item-price">
                                        <div class="price-box"> <span class="regular-price"> <span class="price">$149.00</span></span></div>
                                    </div>
                                    <div class="actions"><a href="#" class="link-wishlist" title="Add to Wishlist"></a>
                                        <div class="add_cart">
                                            <button class="button btn-cart" type="button"><span>Add to Cart</span></button>
                                        </div>
                                        <a href="#" class="link-compare" title="Add to Compare"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info"><a class="product-image" title="Product tilte is here" href="#"> <img alt="Product tilte is here" src="images/products/product-fashion-1.jpg"> </a>
                                <div class="sale-label sale-top-left">sale</div>
                                <div class="mask-shop-white"></div>
                                <div class="new-label new-top-left">new</div>
                                <a class="quickview-btn" href="quick-view.html"><span>Quick View</span></a> <a href="wishlist.html">
                                    <div class="mask-left-shop"><i class="fa fa-heart"></i></div>
                                </a> <a href="compare.html">
                                    <div class="mask-right-shop"><i class="fa fa-signal"></i></div>
                                </a>
                            </div>
                        </div>
                        <div class="item-info">
                            <div class="info-inner">
                                <div class="item-title"> <a title="Product tilte is here" href="#">Product tilte is here </a> </div>
                                <div class="item-content">
                                    <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> </div>
                                    <div class="item-price">
                                        <div class="price-box"> <span class="regular-price"> <span class="price">$139.55</span></span></div>
                                    </div>
                                    <div class="actions"><a href="#" class="link-wishlist" title="Add to Wishlist"></a>
                                        <div class="add_cart">
                                            <button class="button btn-cart" type="button"><span>Add to Cart</span></button>
                                        </div>
                                        <a href="#" class="link-compare" title="Add to Compare"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div> -->