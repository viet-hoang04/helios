<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý thông tin liên hệ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=contact">Danh sách liên hệ</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=contact&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Trả lời liên hệ</h3>
                        <div class="card-tools">
                            <button type="submit" name="TRALOILIENHE" class="btn btn-success">
                                <i class="fa fa-save"></i> Lưu[Trả lời]
                            </button>
                            <a class="btn btn-secondary" href="index.php?option=contact">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Tiêu đề:</label>
                                <input type="text" id="title" name="title" value="<?= $row['title'] ?>" class="form-control" readonly>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="parentid">Thông tin người gửi:</label><br>
                                - Họ tên: <?= $row['fullname'] ?><br>
                                - Email: <?= $row['email'] ?><br>
                                - SĐT: <?= $row['phone'] ?><br>
                            </div>
                            <div class="form-group">
                                <label for="detail">Nội dung liên hệ:</label>
                                <textarea id="detail" name="detail" class="form-control" rows="3" readonly><?= $row['detail'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_return">Trả lời liên hệ: </label>
                                <textarea id="contact_return" name="contact_return" class="form-control" rows="10"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="TRALOILIENHE" class="btn btn-success">
                                <i class="fa fa-save"></i> Lưu[Trả lời]
                            </button>
                            <a class="btn btn-secondary" href="index.php?option=contact">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </form>
    </section>
    <!-- /.content -->
</div>
<script>
    $(function() {
        //Initialize Elements
        $('.select2').select2()
    });
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>