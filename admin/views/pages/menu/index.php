<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Tất cả menu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- /.content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title font-weight-bold py-2">Quản lý menu</h3>
                </div>
            </div>
            <div class="card-body">
                <form action="index.php?option=menu&act=insert" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-secondary">
                                <!-- Loại sản phẩm -->
                                <div class="card-header">
                                    <h3 class="card-title">Vị trí menu</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select class="form-control custom-select" id="position" name="position" data-placeholder="Chọn vị trí menu" style="width: 100%;">
                                            <option value="headermenu">Menu Header</option>
                                            <option value="megamenu">Megamenu</option>
                                            <option value="footermenu">Menu Footer</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-secondary">
                                <!-- Loại sản phẩm -->
                                <div class="card-header">
                                    <h3 class="card-title">Loại sản phẩm</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <?php foreach ($list_category as $rcat) : ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="itemcat[]" type="checkbox" id="itemcategory-<?= $rcat['slug'] ?>" value="<?= $rcat['id'] ?>">
                                                <label for="itemcategory-<?= $rcat['slug'] ?>" class="custom-control-label"><?= $rcat['name'] ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success form-control" name="ADD_CATEGORY">Thêm danh mục</button>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-secondary">
                                <!-- Trang đơn -->
                                <div class="card-header">
                                    <h3 class="card-title">Trang đơn</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <?php foreach ($list_singlepage as $rpage) : ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="itempage[]" type="checkbox" id="itempage-<?= $rpage['slug'] ?>" value="<?= $rpage['id'] ?>">
                                                <label for="itempage-<?= $rpage['slug'] ?>" class="custom-control-label"><?= $rpage['title'] ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success form-control" name="ADD_PAGE">Thêm trang đơn</button>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-secondary">
                                <!-- Chủ đề -->
                                <div class="card-header">
                                    <h3 class="card-title">Chủ đề</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="height: 250px; overflow-y: scroll;">
                                    <?php foreach ($list_topic as $rtopic) : ?>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="itemtopic[]" type="checkbox" id="itemtopic-<?= $rtopic['slug'] ?>" value="<?= $rtopic['id'] ?>">
                                                <label for="itemtopic-<?= $rtopic['slug'] ?>" class="custom-control-label"><?= $rtopic['name'] ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success form-control" name="ADD_TOPIC">Thêm chủ đề</button>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-secondary">
                                <!-- Tự tạo liên kết -->
                                <div class="card-header">
                                    <h3 class="card-title">Tuỳ biến liên kết</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên menu</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Tên menu">
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Liên kết</label>
                                        <input type="text" id="link" name="link" class="form-control" placeholder="#">
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-success form-control" name="ADD_CUSTOM">Tạo menu</button>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>



                        <div class="col-md-9">
                            <!-- Menu vị trí header -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách menu vị trí Header</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" style="width:100%" class="display table datatable table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="20px">#</th>
                                                <th class="text-center">Thông tin menu</th>
                                                <th class="text-center">loại</th>
                                                <th class="text-center" width="100px">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_menu_header as $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $item['id']; ?></td>
                                                    <td>
                                                        + Tên: <?= $item['name']; ?> <br>
                                                        + Đường dẫn: <?= $item['link']; ?>
                                                    </td>
                                                    <td class="text-center"><?= $item['type']; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($item['status'] == 1) : ?>
                                                            <a class="btn btn-sm btn-success" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>"><i class="fa fa-toggle-on"></i></a>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>"><i class="fa fa-toggle-off"></i></a>
                                                        <?php endif; ?>
                                                        <a class="btn btn-sm btn-info" href="index.php?option=menu&act=update&id=<?= $item['id']; ?>"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $item['id']; ?>" data-toggle="tooltip" title="Xoá">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="confirmDeleteModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận Xoá</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xoá?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Thẻ a gọi đến liên kết xoá -->
                                                                <a href="index.php?option=menu&act=delete&id=<?= $item['id']; ?>" class="btn btn-danger">Xoá</a>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Menu vị trí megamenu -> menu chính -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách menu vị trí megamenu</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" style="width:100%" class="display table datatable table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="20px">#</th>
                                                <th class="text-center">Thông tin menu</th>
                                                <th class="text-center">Loại</th>
                                                <th class="text-center" width="150px">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_menu_main as $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $item['id']; ?></td>
                                                    <td>
                                                        + Tên: <?= $item['name']; ?> <br>
                                                        + Đường dẫn: <?= $item['link']; ?>
                                                    </td>
                                                    <td class="text-center"><?= $item['type']; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($item['status'] == 1) : ?>
                                                            <a class="btn btn-sm btn-success" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>"><i class="fa fa-toggle-on"></i></a>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>"><i class="fa fa-toggle-off"></i></a>
                                                        <?php endif; ?>
                                                        <a class="btn btn-sm btn-info" href="index.php?option=menu&act=update&id=<?= $item['id']; ?>"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $item['id']; ?>" data-toggle="tooltip" title="Xoá">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmDeleteModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận Xoá</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xoá?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Thẻ a gọi đến liên kết xoá -->
                                                                <a href="index.php?option=menu&act=delete&id=<?= $item['id']; ?>" class="btn btn-danger">Xoá</a>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Menu vị trí footer -->
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Danh sách menu vị trí footer</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" style="width:100%" class="display table datatable table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="20px">#</th>
                                                <th class="text-center">Thông tin menu</th>
                                                <th class="text-center">Loại</th>
                                                <th class="text-center" width="150px">Chức năng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_menu_footer as $item) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $item['id']; ?></td>
                                                    <td>
                                                        + Tên: <?= $item['name']; ?> <br>
                                                        + Đường dẫn: <?= $item['link']; ?>
                                                    </td>
                                                    <td class="text-center"><?= $item['type']; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($item['status'] == 1) : ?>
                                                            <a class="btn btn-sm btn-success" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>" data-toggle="tooltip" title="Hoạt động"><i class="fa fa-toggle-on"></i></a>
                                                        <?php else : ?>
                                                            <a class="btn btn-sm btn-danger" href="index.php?option=menu&act=status&id=<?= $item['id']; ?>" data-toggle="tooltip" title="Tạm ngưng"><i class="fa fa-toggle-off"></i></a>
                                                        <?php endif; ?>
                                                        <a class="btn btn-sm btn-info" href="index.php?option=menu&act=update&id=<?= $item['id']; ?>" data-toggle="tooltip" title="Cập nhật"><i class="fa fa-edit"></i></a>
                                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?= $item['id']; ?>" data-toggle="tooltip" title="Xoá">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="confirmDeleteModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận Xoá</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xoá?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Thẻ a gọi đến liên kết xoá -->
                                                                <a href="index.php?option=menu&act=delete&id=<?= $item['id']; ?>" class="btn btn-danger">Xoá</a>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Quay lại</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->