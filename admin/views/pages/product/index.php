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
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
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
                                <h3 class="card-title font-weight-bold py-2">Danh sách sản phẩm</h3>
                                <div class="card-tools">
                                    <a class="btn btn-primary" href="index.php?option=product&act=insert">
                                        <i class="fa fa-plus"></i> Thêm mới
                                    </a>
                                    <a class="btn btn-secondary" href="index.php?option=product&act=trash">
                                        <i class="fa fa-trash"></i> Thùng rác
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
                                        <th class="text-center" width="100px">Hình</th>
                                        <th class="text-center" width="200px">Thông tin sản phẩm</th>
                                        <th class="text-center" width="100px">Loại</th>
                                        <th class="text-center" width="100px">Thương hiệu</th>
                                        <th class="text-center" width="100px">Thống kê</th>
                                        <th class="text-center" width="100px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list_product as $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $row['id']; ?></td>
                                            <td class="text-center">
                                                <div id="imageSlider<?= $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php foreach ($row['image_list'] as $key => $img) : ?>
                                                            <div class="carousel-item <?= ($key === 0) ? 'active' : ''; ?>">
                                                                <img src="../public/images/product/<?= $img['image']; ?>" class="d-block w-100" alt="Image">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#imageSlider<?= $row['id']; ?>" data-slide="prev">
                                                        <span class="carousel-control-prev-icon"></span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#imageSlider<?= $row['id']; ?>" data-slide="next">
                                                        <span class="carousel-control-next-icon"></span>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                Tên: <?= $row['name']; ?> <br>
                                                SKU: <?= $row['SKU']; ?><br>
                                            </td>
                                            <td class="text-center"><?= $row['category_name']; ?></td>
                                            <td class="text-center"><?= $row['brand_name']; ?></td>
                                            <td class="text-left">
                                                <?php if ($row['quantity'] > 0) : ?>
                                                    - Kho: <?= $row['quantity']; ?><br>
                                                <?php else : ?>
                                                    - Hết hàng<br>
                                                <?php endif; ?>
                                                - Lượt xem: <?= $row['view']; ?><br>
                                                - Đã bán: <?= $row['sold_count']; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php if ($row['quantity'] > 0) : ?>
                                                            <?php if ($row['status'] == 1) : ?>
                                                                <a class="btn btn-sm btn-success" style="margin:2%" href="index.php?option=product&act=status&id=<?= $row['id']; ?>" data-toggle="tooltip" title="Mở bán"><i class="fa fa-toggle-on"></i></a>
                                                            <?php else : ?>
                                                                <a class="btn btn-sm btn-danger" style="margin:2%" href="index.php?option=product&act=status&id=<?= $row['id']; ?>" data-toggle="tooltip" title="Tạm ngưng"><i class="fa fa-toggle-off"></i></a>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-danger" style="margin:2%" data-toggle="tooltip" title="Tạm ngưng"><i class="fa fa-toggle-off"></i></a>
                                                        <?php endif; ?>
                                                        <button type="button" class="btn btn-sm btn-info" style="margin:2%" data-toggle="modal" data-target="#detail-<?= $row['id']; ?>" data-toggle="tooltip" title="Xem chi tiết"><i class="fa fa-eye"></i></button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="btn btn-sm btn-info" style="margin:2%" href="index.php?option=product&act=update&id=<?= $row['id']; ?>" data-toggle="tooltip" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                                        <a class="btn btn-sm btn-warning" style="margin:2%" href="index.php?option=product&act=comment&id=<?= $row['id']; ?>" data-toggle="tooltip" title="Quản lí bình luận"><i class="fa fa-list"></i></a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a class="btn btn-sm btn-danger" style="margin:2%;width:65%" href="index.php?option=product&act=deltrash&id=<?= $row['id']; ?>" data-toggle="tooltip" title="Xoá"><i class="fa fa-trash"></i> Xoá</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div id="detail-<?= $row['id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Thông tin sản phẩm </h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="name">Tên sản phẩm:</label>
                                                                    <input type="text" class="form-control" name="name" id="name" value="<?= $row['name'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="category_name">Loại sản phẩm:</label>
                                                                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?= $row['category_name'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="brand_name">Thương hiệu:</label>
                                                                    <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?= $row['brand_name'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="material">Chất liệu:</label>
                                                                    <input type="text" class="form-control" name="material" id="material" value="<?= $material["name"]; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="size">Kích cỡ:</label>
                                                                    <?php if (!empty($row['sizes'])) : ?>
                                                                        <?php $sizeString = implode(', ', array_column($row['sizes'], 'name_size')); ?>
                                                                        <input type="text" class="form-control" name="size" id="size" value="<?= $sizeString; ?>" readonly>
                                                                    <?php else : ?>
                                                                        <p>No sizes available</p>
                                                                    <?php endif; ?>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">

                                                                <div class="form-group">
                                                                    <label for="price">Giá sản phẩm:</label>
                                                                    <input type="text" class="form-control" name="price" id="price" value="<?= number_format($row['price']); ?> Vnđ" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="promotion">Khuyến mãi:</label>
                                                                    <input type="text" class="form-control" name="promotion" id="promotion" value="<?= number_format($row['promotion']); ?> (%)" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="quantity">Số lượng kho: </label>
                                                                    <input type="text" class="form-control" name="quantity" id="quantity" value="<?= number_format($row['quantity']); ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Trạng thái (*): </label>
                                                                    <input type="text" class="form-control" name="status" id="status" value="<?= $row['status'] === 1 ? 'Còn bán' : 'Ngưng bán'; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="current_img">Hình ảnh:</label>
                                                                    <div id="imageSlider<?= $row['id']; ?>" class="carousel slide" data-ride="carousel">
                                                                        <div class="carousel-inner">
                                                                            <?php foreach ($row['image_list'] as $key => $img) : ?>
                                                                                <div class="carousel-item <?= ($key === 0) ? 'active' : ''; ?>">
                                                                                    <img src="../public/images/product/<?= $img['image']; ?>" class="d-block w-100" alt="Image">
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                        <a class="carousel-control-prev" href="#imageSlider<?= $row['id']; ?>" data-slide="prev">
                                                                            <span class="carousel-control-prev-icon"></span>
                                                                        </a>
                                                                        <a class="carousel-control-next" href="#imageSlider<?= $row['id']; ?>" data-slide="next">
                                                                            <span class="carousel-control-next-icon"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
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