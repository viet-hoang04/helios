<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý liên hệ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý liên hệ</li>
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
                                <h3 class="card-title font-weight-bold py-2">Kho lữu trữ liên hệ</h3>
                                <div class="card-tools">
                                    <a class="btn btn-info" href="index.php?option=contact">
                                        <i class="fa fa-arrow-left"></i> Thoát
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
                                        <th class="text-center">Thông tin liên hệ</th>
                                        <th class="text-center">Tiêu đề</th>
                                        <th class="text-center">Trạng thái</th>
                                        <!-- <th class="text-center" width="150px">Chức năng</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_contact as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $row['id']; ?></td>

                                            <td class="text-center">
                                                Người gửi: <?= $row['fullname']; ?><br>
                                                Email: <?= $row['email']; ?><br>
                                                SĐT: <?= $row['phone']; ?>
                                            </td>
                                            <td class="text-center"><?= $row['title'] ?></td>
                                            <td class="text-center">
                                                <?php if ($row['status'] == 1) : ?>
                                                    Đã trả lời
                                                <?php else : ?>
                                                    Chưa trả lời
                                                <?php endif; ?>
                                            </td>
                                            <!-- <td class="text-center">
                                                <a class="btn btn-sm btn-danger" href="index.php?option=contact&act=delete&id=<?= $row['id']; ?>" style="width:80%; margin:2%"><i class="fa fa-trash"></i> Xoá</a>
                                            </td> -->
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