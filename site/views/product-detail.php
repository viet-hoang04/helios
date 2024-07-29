<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a href="?option=page&act=home" title="Go to Home Page">Home</a> <span>/</span>
                    </li>
                    <li><a href="?option=page&act=product" title="">Sản phẩm</a> <span>/ </span></li>
                    <li> <strong>
                            <?= $row['name']; ?>
                        </strong> </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->

<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="container">
        <div class="row">
            <div class="product-view">
                <div class="product-essential">
                    <form action="?option=cart&act=add-cart&pid=<?= $row['id'] ?>" method="post" enctype="multipart/form-data" id="product_addtocart_form">
                        <input type="hidden" name="return_url" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                            <div class="product-image">
                                <div class="product-full">
                                    <img id="product-zoom" src="../public/images/product/<?= $row['product_img'] ?>" data-zoom-image="../public/images/product/<?= $row['product_img'] ?>" alt="product-image" />
                                </div>
                                <div class="more-views">
                                    <div class="slider-items-products">
                                        <div id="jtv-more-views-img" class="product-flexslider hidden-buttons product-img-thumb">
                                            <div class="slider-items slider-width-col4 block-content">
                                                <?php
                                                // Hiển thị tất cả các hình ảnh từ mảng more_images
                                                foreach ($row['more_images'] as $img) :
                                                ?>
                                                    <div class="more-views-items">
                                                        <a href="#" data-image="../public/images/product/<?= $img ?>" data-zoom-image="../public/images/product/<?= $img ?>">
                                                            <img id="product-zoom" src="../public/images/product/<?= $img ?>" alt="product-image" />
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end: more-images -->
                        </div>
                        <div class="product-shop col-lg-8 col-sm-7 col-xs-12">
                            <div class="product-name">
                                <h1>
                                    <?= $row['name']; ?>
                                </h1>
                            </div>
                            <div class="product-sku">
                                Mã: <?= $row['SKU']; ?>
                            </div>
                            <div class="price-block">
                                <div class="price-box">
                                    <?php
                                    $firstSizePrinted = false;
                                    foreach ($list_size as $item) :
                                        if (!$firstSizePrinted) :
                                            $firstSizePrinted = true; // Đánh dấu là đã in ra giá tiền kích thước đầu tiên
                                            $calculated_price = $row['promotion'] > 0 ? $item['temp_price'] - ($item['temp_price'] * $row['promotion'] / 100) : $item['temp_price'];
                                    ?>
                                            <p class="regular-price">
                                                <span class="price" id="displayedPrice">
                                                    Giá: <?= number_format($calculated_price) ?> VNĐ
                                                </span>
                                            </p>
                                            <?php if ($row['promotion'] > 0) : ?>
                                                <p class="old-price">
                                                    <span class="price">
                                                        <span id="originalPrice"><?= number_format($item['temp_price']) ?></span> VNĐ
                                                    </span>
                                                </p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ($row['status'] == 1) : ?>
                                        <p class="availability in-stock">
                                            <span>Còn hàng</span>
                                        </p>
                                    <?php else : ?>
                                        <p class="availability out-of-stock">
                                            <span>Hết hàng</span>
                                        </p>
                                    <?php endif; ?>
                                    <div class="product-shop form-group" style="display:flex">
                                        <h4 class="mt-3">CHẤT LIỆU: </h4>
                                        <!-- Thay thế class bằng id -->
                                        <label class="text-center" id="material" for="material">
                                            <span class="form-control  text-xl" style="border:none;padding-left:20px;font-size:large;padding-top:7px"><?= $material_name ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="short-description" style="margin-top:-30px">
                                <h2>Mô tả sản phẩm: </h2>
                                <?= $row['smdetail'] ?>
                            </div>
                            <div class="product-shop" data-toggle="buttons">
                                <h4 class="mt-3">Kích cỡ: </h4>
                                <input type="hidden" name="selected_size" id="selectedSize" value="<?= isset($selected_size) ? $selected_size : (isset($list_size[0]['name_size']) ? $list_size[0]['name_size'] : ''); ?>">
                                <input type="hidden" name="calculated_price" id="calculatedPrice" value="<?= isset($calculated_price) ? $calculated_price : (isset($list_size[0]['temp_price']) ? $list_size[0]['temp_price'] : ''); ?>">
                                <?php foreach ($list_size as $id => $item) : ?>
                                    <!-- Thay thế class bằng id -->
                                    <label class="btn btn-default text-center" id="size-<?= $item['id'] ?>" for="size-<?= $item['id'] ?>" style="background-color: white;border:1px solid #ddd">
                                        <a class="size-label" data-temp-price="<?= $item['temp_price'] ?>" data-size="<?= $item['name_size'] ?>">
                                            <span class="text-xl">
                                                <?= $item['name_size'] ?>
                                            </span>
                                        </a>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <div class="add-to-box">
                                <div class="add-to-cart row">
                                    <div class="pull-left">
                                        <div class="custom pull-left">
                                            <label>Quantity:</label>
                                            <?php if ($row['quantity'] > 0) : ?>
                                                <button onClick="var result = document.getElementById('qty'); var qty = parseInt(result.value); if (!isNaN(qty) && qty > 1) result.value = qty - 1;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus">&nbsp;</i>
                                                </button>
                                                <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                                                <button onClick="var result = document.getElementById('qty'); var qty = parseInt(result.value); if (!isNaN(qty)) result.value = qty + 1;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus">&nbsp;</i>
                                                </button>
                                            <?php else : ?>
                                                <button disabled onClick="var result = document.getElementById('qty'); var qty = parseInt(result.value); if (!isNaN(qty) && qty > 1) result.value = qty - 1;" class="reduced items-count" type="button">
                                                    <i class="fa fa-minus">&nbsp;</i>
                                                </button>
                                                <input readonly="true" type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                                                <button disabled onClick="var result = document.getElementById('qty'); var qty = parseInt(result.value); if (!isNaN(qty)) result.value = qty + 1;" class="increase items-count" type="button">
                                                    <i class="fa fa-plus">&nbsp;</i>
                                                </button>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <button class="button btn-cart" title="Thêm giỏ hàng" type="sumit">
                                        <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                    </button>
                                </div>
                                <div class="email-addto-box">
                                    <ul class="add-to-links">
                                        <li>
                                            <a class="link-wishlist" href="index.php?option=page&act=add-wishlist&pid=<?= $item['id'] ?>" data-toggle="tooltip" title="Yêu thích">
                                                <div class="mask-left-shop">
                                                    <i class="fa fa-heart"></i> THÊM YÊU THÍCH
                                                </div>
                                            </a>
                                        </li>
                                        <!-- <li><a class="link-compare" href="compare.html"><i class="fa fa-signal"></i><span>Add to Compare</span></a></li>
                                        <li><a class="email-friend" href="#"><i class="fa fa-envelope"></i><span>Email
                                                    to a Friend</span></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <!-- <div class="social">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-next-prev"> <a class="product-next" href="#"><i class="fa fa-angle-left"></i></a> <a class="product-prev" href="#"><i class="fa fa-angle-right"></i></a> </div> -->
                        </div>
                    </form>
                </div>
            </div>
            <div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
                <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
                    <li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Chi tiết sản phẩm </a>
                    </li>
                    <li><a href="#reviews_tabs" data-toggle="tab">Bình luận</a></li>
                </ul>
                <div id="productTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="product_tabs_description">
                        <div class="std">
                            <?= $row['detail'] ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews_tabs">
                        <div class="box-collateral box-reviews" id="customer-reviews">
                            <div class="box-reviews1">
                                <div class="form-add">
                                    <?php if (isset($_SESSION['user'])) : ?>
                                        <form id="review-form" method="post" action="index.php?option=page&act=review">
                                            <h3>Viết bình luận & đánh giá về sản phẩm của bạn</h3>
                                            <fieldset>
                                                <h4>How do you rate this product? <em class="required">*</em></h4>
                                                <div class="review1">
                                                    <ul class="form-list">
                                                        <li>
                                                            <label class="required" for="fullname">Họ tên<em>*</em></label>
                                                            <div class="input-box">
                                                                <input type="text" class="input-text" id="fullname" name="fullname" value="<?= $_SESSION['user']['fullname'] ?>">
                                                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                                                <input type="hidden" name="slug" value="<?= $row['slug'] ?>">
                                                                <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?>">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <label class="required" for="email">Email<em>*</em></label>
                                                            <div class="input-box">
                                                                <input type="text" class="input-text" id="email" name="email" value="<?= $_SESSION['user']['email'] ?>">
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="review2">
                                                    <ul>
                                                        <li>
                                                            <label class="required " for="detail">Nội dung<em>*</em></label>
                                                            <div class="input-box">
                                                                <textarea rows="3" cols="5" id="detail" name="detail"></textarea>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="buttons-set">
                                                        <button class="button submit" title="Gửi đánh giá" type="submit"><span>Gửi đánh giá</span></button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    <?php else : ?>
                                        <h3>Bạn cần đăng nhập mới có thể bình luận được.</h3>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="box-reviews2">
                                <h3>Các bình luận đánh giá</h3>
                                <div class="box visible">
                                    <ul>
                                        <?php foreach ($list_comment as $item) : ?>
                                            <li>
                                                <!-- <table class="ratings-table">
                                                <tbody>
                                                    <tr>
                                                        <th>Value</th>
                                                        <td>
                                                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Quality</th>
                                                        <td>
                                                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>
                                                            <div class="rating"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                                <div class="review">
                                                    <h6><?= $item['email'] ?></h6>
                                                    <small>Đánh giá bởi <span><?= $item['fullname'] ?> </span>ngày <?= $item['created_at'] ?> </small>
                                                    <div class="review-txt"><?= $item['detail'] ?></div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <!-- <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Main Container End -->

<!-- Related Products Slider -->

<?php if (count($list_other) > 0) : ?>
    <div class="container">
        <div class="jtv-related-products">
            <div class="slider-items-products">
                <div class="jtv-new-title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
                <div class="related-block">
                    <div id="jtv-related-products-slider" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col4 products-grid">
                            <?php foreach ($list_other as $item) : ?>
                                <div class="item">
                                    <div class="item-inner">
                                        <div class="item-img">
                                            <div class="item-img-info">
                                                <a class="product-image" title="<?= $item['name'] ?>" href="?option=page&act=product-detail&slug=<?= $item['slug'] ?>">
                                                    <img alt="<?= $item['name'] ?>" src="../public/images/product/<?= $item['image'] ?>">
                                                </a>
                                                <div class="mask-shop-white"></div>
                                                <a href="index.php?option=page&act=add-wishlist&pid=<?= $item['id'] ?>" data-toggle="tooltip" title="Yêu thích">
                                                    <div class="mask-left-shop">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                </a>
                                                <a href="index.php?option=cart&act=add-cart&pid=<?= $item['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                    <div class="mask-right-shop">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item-info">
                                            <div class="info-inner">
                                                <div class="item-title">
                                                    <a title="<?= $item['name']; ?>" href="?option=page&act=product-detail&slug=<?= $item['slug'] ?>">
                                                        <?= $item['name']; ?>
                                                    </a>
                                                </div>
                                                <div class="item-content">
                                                    <div class="item-price">
                                                        <div class="price-box">
                                                            <?php if ($item['promotion'] > 0) : ?>
                                                                <span class="regular-price">
                                                                    <span class="price">
                                                                        <?= number_format($item['price'] - ($item['price'] * $item['promotion'] / 100)) ?>
                                                                        Vnđ
                                                                    </span>
                                                                </span>
                                                                <p class="old-price">
                                                                    <span class="price-label">Regular Price:</span>
                                                                    <span class="price">
                                                                        <?= number_format($item['price']) ?> Vnđ
                                                                    </span>
                                                                </p>
                                                            <?php else : ?>
                                                                <span class="regular-price">
                                                                    <span class="price">
                                                                        <?= number_format($item['price']) ?> Vnđ
                                                                    </span>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
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
        </div>
    </div>
<?php endif; ?>
<!-- Related Products Slider End -->
<?php
$message = get_flash('message');
if ($message && isset($message['type'])) {
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '    $("#successModal").modal("show");'; // Chỉ định ID của modal của bạn
    echo '});';
    echo '</script>';
}
?>
<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel"> <?= $message['title'] ?>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            <div class="modal-body">
                <?= $message['msg'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>