<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý sản phẩm</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=product">Danh sách sản phẩm</a></li>
                        <li class="breadcrumb-item active">Quản lý bình luận</li>
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
                                <h3 class="card-title font-weight-bold py-2">Quản lý bình luận</h3>
                                <div class="card-tools">
                                    <a class="btn btn-secondary" href="index.php?option=product">
                                        <i class="fa fa-undo"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" style="width:100%" class="datatable table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10px">#</th>
                                        <th class="text-center" width="100px">Người tạo</th>
                                        <th class="text-center" width="200px">Tiêu đề</th>
                                        <th class="text-center" width="100px">Ngày tạo</th>
                                        <th class="text-center" width="100px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_comment as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $row['id'] ?></td>
                                            <td class="text-center"><?= $row['fullname'] ?></td>
                                            <td class="text-center"><?= $row['email'] ?></td>
                                            <td class="text-center"><?= $row['created_at'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info" style="margin:2%" data-toggle="modal" data-target="#myModal" data-fullname="<?= $row['fullname'] ?>" data-email="<?= $row['email'] ?>" data-createdat="<?= $row['created_at'] ?>" title="Xem chi tiết">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <a class="btn btn-sm btn-danger" style="margin:2%" href="index.php?option=product&act=delete_cmt&cid=<?= $row['id']; ?>" data-toggle="tooltip" title="Xoá"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Chi tiết bình luận:</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Nội dung chi tiết bình luận sẽ được hiển thị ở đây -->
                                                        <!-- Bạn có thể thêm các trường thông tin chi tiết từ dữ liệu $row -->
                                                        <p>Người tạo: <span id="modalFullName"><?= $row['fullname'] ?></span></p>
                                                        <p>Ngày tạo: <span id="modalTitle"><?= $row['created_at'] ?></span></p>
                                                        <!-- Thêm các trường thông tin khác nếu cần -->
                                                        <span>Nội dung:</span>
                                                        <hr>
                                                        <p><?= $row['detail'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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