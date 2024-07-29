<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../public/images/logo.png" alt="Fabulous Logo" class="brand-image mx-auto my-auto" style="opacity: .8">
        <span class="brand-text font-weight-light">CPanel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional)
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#"></a>
            </div>
        </div> -->

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent nav-legacy flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php?option=dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-box"></i>
                        <p>
                            Quản lý sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?option=product" class="nav-link">
                                <i class="fa fa-box-open nav-icon"></i>
                                <p>Quản lý sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=size" class="nav-link">
                                <i class="fa fa-compress-arrows-alt nav-icon"></i>
                                <p>Quản lý kích cỡ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=material" class="nav-link">
                                <i class="fa fa-folder nav-icon"></i>
                                <p>Quản lý chất liệu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=category" class="nav-link">
                                <i class="fa fa-code-branch nav-icon"></i>
                                <p>Danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=brand" class="nav-link">
                                <i class="fa fa-copyright nav-icon"></i>
                                <p>Thương hiệu</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Quản lý bài viết
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?option=post" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Tất cả bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=topic" class="nav-link">
                                <i class="fa fa-quote-left nav-icon"></i>
                                <p>Chủ đề</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=single_page" class="nav-link">
                                <i class="fa fa-clipboard nav-icon"></i>
                                <p>Trang đơn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-parachute-box"></i>
                        <p>
                            Quản lý bán hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?option=order" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Tất cả đơn hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=customer" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Danh sách khách hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=rank" class="nav-link">
                                <i class="fa fa-user-shield nav-icon"></i>
                                <p>Danh sách cấp bậc</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?option=contact" class="nav-link">
                        <i class="nav-icon fa fa-phone"></i>
                        <p>
                            Liên hệ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-desktop"></i>
                        <p>
                            Giao diện
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?option=menu" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=slider" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=banner" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Banner quảng cáo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Hệ thống
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?option=config" class="nav-link">
                                <i class="fa fa-tv nav-icon"></i>
                                <p>Cấu hình website</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?option=user" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Danh sách quản trị viên</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="nav-header">Trang đơn</li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>