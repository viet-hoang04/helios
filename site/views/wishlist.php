<div class="main-container col1-layout">
    <div class="container">
        <div class="row">
            <section class="col-sm-12 col-xs-12">
                <div class="cart-page-area">
                    <h2>Sản phẩm yêu thích</h2>
                    <?php if (count($list_wishlist) > 0) : ?>
                        <div class="table-responsive">
                            <table class="shop-cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Hình ảnh</th>
                                        <th class="product-name ">Tên sản phẩm</th>
                                        <th class="product-price ">Giá</th>
                                        <th class="product-subtotal ">Kho</th>
                                        <th class="product-quantity">Thêm giỏ hàng</th>
                                        <th class="product-remove">Xoá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_wishlist as $row) : ?>
                                        <?php
                                        $firstImage = !empty($row['product']['more_images']) ? $row['product']['more_images'][0] : '';
                                        ?>

                                        <tr class="cart_item">
                                            <td class="item-img">
                                                <a href="index.php?option=page&act=product-detail&slug=<?= $row['product']['slug'] ?>">
                                                    <img alt="Product title is here" src="../public/images/product/<?= $firstImage ?>">
                                                </a>
                                            </td>
                                            <td class="item-title">
                                                <a href="index.php?option=page&act=product-detail&slug=<?= $row['product']['slug'] ?>"><?= $row['product']['name'] ?> </a>
                                            </td>
                                            <td class="item-price">
                                                <?php if ($row['product']['promotion'] > 0) : ?>
                                                    <span class="regular-price" id="displayedPrice">
                                                        <span class="price">
                                                            <?= number_format($row['promotion_price']) ?> Vnđ
                                                        </span>
                                                    </span>
                                                    <p class="old-price">
                                                        <span class="price-label">Giá gốc:</span>
                                                        <span class="price"><?= number_format($row['old_price']) ?> Vnđ </span>
                                                    </p>
                                                <?php else : ?>
                                                    <span class="regular-price">
                                                        <span class="price">
                                                            <?= number_format($row['old_price']) ?> Vnđ
                                                        </span>
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <td class="item-qty">
                                                <?= $row['product']['quantity'] ?>
                                            </td>
                                            <td class="total-price">
                                                <a class="btn-def btn2" href="index.php?option=cart&act=add-cart&pid=<?= $row['product']['id'] ?>" data-toggle="tooltip" title="Thêm giỏ hàng">
                                                    <div class="mask-right-shop">
                                                        <i class="fa fa-shopping-cart"> Thêm giỏ hàng</i>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="remove-item">
                                                <a href="index.php?option=page&act=del-wishlist&id=<?= $row['id'] ?>">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                            <div class="cart-page-area">
                                <div class="col-xs-12 text-center">
                                    <div class="pages">
                                        <div class="pagination">
                                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                <a href="index.php?option=wishlist&page=<?= $i ?>" <?= ($currentPage == $i) ? 'class="active"' : '' ?>><?= $i ?></a>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php else : ?>
                        <h3>Bạn chưa có sản phẩm yêu thích nào</h3>
                        <p>Quay lại <a href="index.php?option=page&act=home">Trang chủ</a></p>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div><?php
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Thao tác thành công
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
</div>