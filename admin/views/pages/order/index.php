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
                        <li class="breadcrumb-item active">Danh sách đơn hàng</li>
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
                                <h3 class="card-title font-weight-bold py-2">Danh sách đơn hàng</h3>
                                <div class="card-tools">
                                    <a class="btn btn-secondary" href="index.php?option=order&act=trash">
                                        <i class="fa fa-trash"></i> Lưu trữ
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
                                        <th class="text-center" width="100px">Chức năng</th>
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
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="orderDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 85%; margin-bottom:5px; text-align: left;">
                                                        Trạng thái
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="orderDropdown">
                                                        <?php if ($row['stage'] != 1) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=1">Chờ duyệt</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 2 && $row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=2">Đang xử lý</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 3 && $row['stage'] == 1 && $row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=3">Huỷ đơn</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 4 && $row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=4">Đang giao</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 5 && $row['stage'] != 3 && $row['stage'] != 6 && $row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=5">Giao thành công</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 6 && $row['stage'] != 5 && $row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=6">Trả hàng/Đổi hàng</a>
                                                        <?php endif; ?>
                                                        <?php if ($row['stage'] != 7) : ?>
                                                            <a class="dropdown-item" href="index.php?option=order&act=stage&id=<?= $row['id']; ?>&value=7">Hoàn thành</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <a class="btn btn-sm btn-info" href="index.php?option=order&act=detail&id=<?= $row['id']; ?>" style="width: 85%;margin-bottom:5px; text-align: left;"> Chi tiết</a>
                                                <a class="btn btn-sm btn-danger" href="index.php?option=order&act=deltrash&id=<?= $row['id']; ?>" style="width: 85%;text-align: left;">Xoá</a>
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