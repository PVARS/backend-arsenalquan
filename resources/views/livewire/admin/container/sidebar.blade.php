<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin') }}" class="brand-link" style="text-align: center">
        <span class="brand-text font-weight-light">Arsenal Quán</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="color: #fff; font-size: 140%;">
                <i class="nav-icon fas fa-user-circle"></i>
            </div>
            <div class="info">
                <a href="javascript:void(0)" class="d-block">Welcome Phan Văn Vũ</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Trang chủ</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/category') ? 'menu-open' : '' }} {{ request()->is('admin/category/categories') ? 'menu-open' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->is('admin/category') ? 'active' : '' }} {{ request()->is('admin/category/categories') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Quản lí danh mục
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category') }}" class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                                <i class="fas fa-folder-plus nav-icon"></i>
                                <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories') }}" class="nav-link {{ request()->is('admin/category/categories') ? 'active' : '' }}">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Danh sách danh mục</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-link-new">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Quản lí bài viết
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="detail-news.php" class="nav-link nav-link-new-detail">
                                <i class="fas fa-plus-square nav-icon"></i>
                                <p>Thêm bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list-news.php" class="nav-link nav-link-new-list">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-link-user">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lí tài khoản
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="detail-user.php" class="nav-link nav-link-user-detail">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Tạo tài khoản</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="list-users.php" class="nav-link nav-link-user-list">
                                <i class="fas fa-list-ul nav-icon"></i>
                                <p>Danh sách tài khoản</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="accept-post.php" class="nav-link nav-link-accept-post">
                        <i class="fas fa-check-square nav-icon"></i>
                        <p>
                            Phê duyệt bài viết
                            <span class="right badge badge-danger">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="setting-system.php" class="nav-link nav-link-setting-system">
                        <i class="fas fa-cog nav-icon"></i>
                        <p>
                            Cài đặt hệ thống
                        </p>
                    </a>
                </li>
            </ul>
            <a href="logout.php" style="position: absolute; bottom: 0; margin-bottom: 20px">
                <i class="fas fa-sign-out-alt nav-icon" style="font-size: 20px"></i>&nbsp
                Đăng xuất
            </a>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>