<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a href="index.php" title="Go to Home Page">Trang chủ</a> <span>/</span></li>
                    <li class="cart"> <a href="index.php?option=cart&act=cart-view" title="Go to Home Page">Giỏ hàng</a> <span>/</span></li>
                    <li> <strong>Thanh toán </strong> </li>
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
                        <?php if ($list != NULL) : ?>
                            <form action="?option=cart&act=insert-order" method="POST" enctype="multipart/form-data">
                                <!-- Checkout are start-->
                                <div class="checkout-area">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="billing-details">
                                                            <div class="contact-text right-side">
                                                                <h2>Thông tin nhận hàng</h2>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="input-box">
                                                                            <label>Họ tên <em>*</em></label>
                                                                            <input type="text" name="fullname" class="info" value="<?= $_SESSION['user']['fullname'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="input-box">
                                                                            <label>Địa chỉ email<em>*</em></label>
                                                                            <input type="email" name="email" class="info" value="<?= $_SESSION['user']['email'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                                        <div class="input-box">
                                                                            <label>Số điện thoại<em>*</em></label>
                                                                            <input type="text" name="phone" class="info" value="<?= $_SESSION['user']['phone'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                        <div class="input-box">
                                                                            <label>Địa chỉ <em>*</em></label>
                                                                            <input type="text" name="address" class="info mb-10" value="<?= $_SESSION['user']['address'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xs-12">
                                                        <div class="billing-details">
                                                            <div class="right-side">
                                                                <div class="ship-acc clearfix">
                                                                    <div class="ship-toggle">
                                                                        <input type="checkbox" id="ship-toggle" name="new_info">
                                                                        <label for="ship-toggle">Bạn muốn giao địa chỉ khác?</label>
                                                                    </div>
                                                                    <div class="ship-acc-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box">
                                                                                    <label>Họ tên <em>*</em></label>
                                                                                    <input type="text" name="other_fullname" class="info">
                                                                                    <span class="error-message" id="fullname-error"><?php echo isset($_SESSION['errors']['fullname']) ? $_SESSION['errors']['fullname'] : ''; ?></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box">
                                                                                    <label>Địa chỉ email<em>*</em></label>
                                                                                    <input type="email" name="other_email" class="info">
                                                                                    <span class="error-message" id="email-error"><?php echo isset($_SESSION['errors']['email']) ? $_SESSION['errors']['email'] : ''; ?></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                <div class="input-box">
                                                                                    <label>Số điện thoại <em>*</em></label>
                                                                                    <input type="text" name="other_phone" class="info">
                                                                                    <span class="error-message" id="phone-error"><?php echo isset($_SESSION['errors']['phone']) ? $_SESSION['errors']['phone'] : ''; ?></span>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                <div class="input-box">
                                                                                    <label>Địa chỉ mới <em>*</em></label>
                                                                                    <input type="text" name="other_address" class="info mb-10">
                                                                                    <span class="error-message" id="address-error"><?php echo isset($_SESSION['errors']['address']) ? $_SESSION['errors']['address'] : ''; ?></span>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form">
                                                                    <div class="input-box">
                                                                        <label>Order Notes</label>
                                                                        <textarea name="order_notes" placeholder="Ghi chú về đơn hàng của bạn" class="area-tex"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                <div class="checkout-payment-area">
                                                    <div class="checkout-total">
                                                        <h3>Giỏ hàng của bạn</h3>
                                                        <div class="table-responsive">
                                                            <table class="checkout-area table">
                                                                <thead>
                                                                    <tr class="cart_item check-heading">
                                                                        <td class="ctg-type"> Sản phẩm</td>
                                                                        <td class="cgt-des"> Giá</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $total = 0;
                                                                    $final = 0 ?>
                                                                    <?php foreach ($list as $item_cart) : ?>
                                                                        <tr class="cart_item check-item prd-name">
                                                                            <?php
                                                                            $sub_total = $item_cart['qty'] * $item_cart['price'];
                                                                            $total += $sub_total;
                                                                            ?>
                                                                            <td class="ctg-type">
                                                                                <?= $item_cart['name'] ?> × <span><?= $item_cart['qty'] ?><br> <?= $item_cart['material'] ?></span>
                                                                            </td>
                                                                            <td class="cgt-des"> <?= number_format($item_cart['qty'] * $item_cart['price']); ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                    <tr class="cart_item">
                                                                        <td class="ctg-type"> Tạm tính</td>
                                                                        <td class="cgt-des"><?= number_format($total); ?></td>
                                                                    </tr>
                                                                    <tr class="cart_item">
                                                                        <td class="ctg-type"> Giảm giá thành viên:</td>
                                                                        <td class="cgt-des"><?= $rank['name'] ?> - <?= $rank['promotion'] ?> %</td>
                                                                    </tr>
                                                                    <tr class="cart_item">
                                                                        <td class="ctg-type">Phương thức thanh toán</td>
                                                                        <td class="cgt-des ship-opt">
                                                                            <div class="shipp">
                                                                                <input type="radio" id="pay-toggle1" name="payment_method" value="1" checked>
                                                                                <label for="pay-toggle1">Tiền mặt</label>
                                                                            </div>
                                                                            <div class="shipp">
                                                                                <input type="radio" id="pay-toggle2" name="payment_method" value="2">
                                                                                <label for="pay-toggle2">Chuyển khoản</label>
                                                                            </div>
                                                                            <div class="shipp">
                                                                                <input type="radio" id="pay-toggle3" name="payment_method" value="3">
                                                                                <label for="pay-toggle3">Ví điện tử</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="cart_item">
                                                                        <td class="ctg-type crt-total"> Thành tiền</td>
                                                                        <td class="cgt-des prc-total"> <span name="total"><?= number_format($final = $total - ($total * $rank['promotion'] / 100)); ?> VNĐ</span></td>
                                                                        <input type="hidden" name="total" value="<?= $final ?>">
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="process-checkout-btn text-right" style="width:50%;">
                                                                <button class="button btn-proceed-checkout" name="PLACEORDER" title="Đặt hàng" type="submit"><span>Thanh toán</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout are end-->
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>