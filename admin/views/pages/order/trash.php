<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=order">Danh sách đơn hàng</a></li>
                        <li class="breadcrumb-item active">Lưu trữ đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title font-weight-bold py-2">Lưu trữ đơn hàng</h3>
                                <div class="card-tools">
                                    <a class="btn btn-primary" href="index.php?option=order">
                                        <i class="fa fa-undo"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" style="width:100%" class="display datatable table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10px">ID</th>
                                        <th class="text-center">Thông tin khách hàng</th>
                                        <th class="text-center">Tổng tiền</th>
                                        <th class="text-center">Ngày tạo hoá đơn</th>
                                        <th class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_order as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $row['id']; ?></td>
                                            <td>
                                                <strong>+ Tên:<?= $row['customer_name']; ?></strong><br>
                                                + Sđt: <?= $row['delivery_phone']; ?><br>
                                                + Địa chỉ: <?= $row['delivery_address']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($row['total_price']) ?> VNĐ
                                            </td>
                                            <td class="text-center">
                                                <?= $row['created_at'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php switch ($row['stage']) {
                                                    case '1':
                                                        echo '<a class="btn btn-sm btn-warning">Chờ duyệt</a>';
                                                        break;
                                                    case '2':
                                                        echo '<a class="btn btn-sm btn-info">Đang xử lý</a>';
                                                        break;
                                                    case '3':
                                                        if ($row['stage'] != 7) {
                                                            echo '<a class="btn btn-sm btn-danger">Huỷ đơn</a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-secondary">Đã hoàn thành</a>';
                                                        }
                                                        break;
                                                    case '4':
                                                        if ($row['stage'] != 7) {
                                                            echo '<a class="btn btn-sm btn-success">Đang giao</a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-secondary">Đã hoàn thành</a>';
                                                        }
                                                        break;
                                                    case '5':
                                                        if ($row['stage'] != 3 && $row['stage'] != 6 && $row['stage'] != 7) {
                                                            echo '<a class="btn btn-sm btn-success">Giao thành công</a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-secondary">Đã hoàn thành</a>';
                                                        }
                                                        break;
                                                    case '6':
                                                        if ($row['stage'] != 7) {
                                                            echo '<a class="btn btn-sm btn-info">Trả hàng/Đổi hàng</a>';
                                                        } else {
                                                            echo '<a class="btn btn-sm btn-secondary">Đã hoàn thành</a>';
                                                        }
                                                        break;
                                                    case '7':
                                                        echo '<a class="btn btn-sm btn-secondary">Hoàn thành</a>';
                                                        break;
                                                }
                                                ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->