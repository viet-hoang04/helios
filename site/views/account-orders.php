<!-- main-container -->
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <section class="col-sm-9 col-xs-12">
                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Danh sách đơn hàng</h2>
                                </div>
                                <div class="col-sm-6">
                                    <?php if (has_flash('message')) : ?>
                                        <?php $error = get_flash('message'); ?>
                                        <div id="myAlert" style="margin: auto;" class="alert alert-<?= $error['type'] ?> " role="alert">
                                            <i class="fa fa-check"></i>
                                            <?= $error['msg']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard">
                            <div class="recent-orders">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-responsive table-bordered datatable text-left my-orders-table">
                                        <thead>
                                            <tr class="first last">
                                                <th>#</th>
                                                <th>Ngày đặt</th>
                                                <th>Địa chỉ nhận</th>
                                                <th><span class="nobr">Tổng tiền</span></th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_order as $row) : ?>
                                                <?php if ($row['status'] == 0 && in_array($row['stage'], [1, 2, 4, 5, 6]) && !in_array($row['stage'], [3, 7])) : ?>
                                                    <?php $orderdetails = $row['order_details']; ?>
                                                    <tr>
                                                        <td><?= $row['id'] ?></td>
                                                        <td><?= $row['created_at'] ?></td>
                                                        <td><?= $row['delivery_address'] ?></td>
                                                        <td><span class="price"><?= number_format($row['total_price']) ?></span></td>
                                                        <td class="text-primary">
                                                            <em>
                                                                <?php if ($row['stage'] == 1) : ?>
                                                                    Chờ duyệt
                                                                <?php elseif ($row['stage'] == 2) : ?>
                                                                    Đang giao
                                                                <?php elseif ($row['stage'] == 4) : ?>
                                                                    Giao thành công
                                                                <?php elseif ($row['stage'] == 5) : ?>
                                                                    Trả hàng/Đổi hàng
                                                                <?php elseif ($row['stage'] == 6) : ?>
                                                                    Đã giao hàng
                                                                <?php endif; ?>
                                                            </em>
                                                        </td>
                                                        <td class="text-center last">
                                                            <div class="btn-group">
                                                                <a href="?option=user&act=view-order&id=<?= $row['id'] ?>" class="btn btn-view-order">Xem đơn hàng</a>
                                                                <?php if ($row['stage'] == 1) : ?>
                                                                    <a href="?option=user&act=cancel-order&id=<?= $row['id'] ?>" class="btn btn-reorder">Huỷ đơn</a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-main">
                    <div class="my-account">
                        <div class="page-title">
                            <h2>Lịch sử đơn hàng</h2>
                        </div>
                        <div class="dasboard" style="margin-top: 10px;">
                            <div class="recent-orders">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-responsive table-bordered text-left datatable my-orders-table">
                                        <thead>
                                            <tr class="first last">
                                                <th>#</th>
                                                <th>Ngày đặt</th>
                                                <th>Địa chỉ nhận</th>
                                                <th><span class="nobr">Tổng tiền</span></th>
                                                <th>Trạng thái</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_order as $row) : ?>
                                                <?php if ($row['status'] != 0 || ($row['status'] == 0 && in_array($row['stage'], [3, 7]))) : ?>
                                                    <tr>
                                                        <td><?= $row['id'] ?></td>
                                                        <td><?= $row['created_at'] ?></td>
                                                        <td><?= $row['delivery_address'] ?></td>
                                                        <td><span class="price"><?= number_format($row['total_price']) ?></span></td>
                                                        <td class="text-primary">
                                                            <em>
                                                                <?php if ($row['status'] == 1) : ?>
                                                                    Đã giao thành công
                                                                <?php elseif ($row['status'] == 2) : ?>
                                                                    Đã huỷ đơn
                                                                <?php endif; ?>
                                                            </em>
                                                        </td>
                                                        <td class="text-center last">
                                                            <div class="btn-group">
                                                                <a href="?option=user&act=view-order&id=<?= $row['id'] ?>" class="btn btn-view-order">Xem chi tiết</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
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
                    <div class="block-title">Quản lý tài khoản</div>
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