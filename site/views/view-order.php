<!-- main-container -->
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9 col-xs-12">
                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>Danh sách đơn hàng</h2>
                            <a href="index.php?option=user&act=history-orders" class="btn btn-reorder" style="margin-left: 20px;">Quay lại</a>
                        </div>
                        <div class="dashboard">
                            <div class="recent-orders">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-responsive table-bordered text-left my-orders-table">
                                        <thead>
                                            <tr class="first last">
                                                <th>#</th>
                                                <th width="150px">Hình ảnh</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Chất liệu</th>
                                                <th>Kích cỡ</th>
                                                <th>Số lượng</th>
                                                <th><span class="nobr">Đơn giá</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $id = 1; ?>
                                            <?php foreach ($list_orderdetail as $item) : ?>
                                                <tr>
                                                    <td><?= $id ?></td>
                                                    <td><img src="../public/images/product/<?= $item['product_img_first'] ?>" alt="<?= $item['product_name'] ?>" class="img-thumbnail"></td>
                                                    <td><?= $item['product_name'] ?></td>
                                                    <td><?= $item['material'] ?></td>
                                                    <td><?= $item['size'] ?></td>
                                                    <td><?= $item['quantity'] ?></td>
                                                    <td><span class="price"><?= number_format($item['price']) ?></span></td>
                                                </tr>
                                                <?php $id++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="col-right sidebar col-sm-3 col-xs-12">
                <div class="block block-account">
                    <div class="block-title">Tài khoản</div>
                    <div class="block-content">
                        <ul>
                            <li><a href="?option=user&act=account"><i class="fa fa-angle-right"></i> Tài khoản</a></li>
                            <li><a href="?option=user&act=account-detail"><i class="fa fa-angle-right"></i> Thông tin tài khoản</a></li>
                            <li class="current"><a href="?option=user&act=history-orders"><i class="fa fa-angle-right"></i> Lịch sử đơn hàng</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
<!--End main-container -->