<?php
$html_topid = '';
foreach ($list_topic as $item) {
    if ($item['id'] == $row['topic_id']) {
        $html_topid .= '<option selected value="' . $item['id'] . '">' . $item['name'] . '</option>';
    } else {
        $html_topid .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý bài viết</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="index.php?option=post">Danh sách bài viết</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa bài viết</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="index.php?option=post&act=update" method="post" enctype="multipart/form-data">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2">Chỉnh sửa bài viết</h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success"><i class="fa fa-save"></i> Lưu[CẬP NHẬT]</button>
                            <a class="btn btn-secondary" href="index.php?option=post">
                                <i class="fa fa-arrow-left"></i> Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="title">Tên bài viết</label>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="text" id="title" name="title" value="<?= $row['title'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="detail">Chi tiết bài viết</label>
                                <textarea id="detail" name="detail" class="form-control summernote" rows="4"><?= $row['detail'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="topic_id">Loại bài viết(*)</label>
                                <select id="topic_id" name="topic_id" class="form-control custom-select">
                                    <option selected>[--Chọn loại bài viết--]</option>
                                    <?= $html_topid ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="img">Hình ảnh đại diện bài viết:</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img">
                                    <label class="custom-file-label" for="img">Chọn hình</label>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="img">Hình ảnh hiện tại:</label>
                                <img src="../public/images/post/<?= $row['img'] ?>" class="img-responsive img-thumbnail w-100">
                            </div>
                            <div class="form-group">
                                <label for="status">Trạng thái </label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected>[--Trạng thái bài viết--]</option>
                                    <option value="1" <?php if ($row['status'] == 1) {
                                                            echo "selected";
                                                        } ?>>Xuất bản</option>
                                    <option value="2" <?php if ($row['status'] == 2) {
                                                            echo "selected";
                                                        } ?>>Không xuất bản</option>
                                    <option value="0" <?php if ($row['status'] == 0) {
                                                            echo "selected";
                                                        } ?>>Lưu trữ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-weight-bold py-2"></h3>
                        <div class="card-tools">
                            <button type="submit" name="CAPNHAT" class="btn btn-success">
                                <i class="fa fa-save"></i> Lưu[CẬP NHẬT]
                            </button>
                            <a class="btn btn-secondary" href="index.php?option=post">
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