<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- File style.css của Theme -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- HEADER / NAVBAR MODULE -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <!-- Tên nhóm -->
        <a class="navbar-brand font-weight-bold mr-4 text-dark" href="<?php echo esc_url(home_url('/')); ?>">Group A</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!-- Khu vực bên trái: Nút Home + Form Search -->
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-secondary px-3" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                </li>
                <li class="nav-item ml-2">
                    <!-- Form tìm kiếm gửi query ?s=... về trang chủ theo chuẩn WordPress -->
                    <form class="form-inline" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input class="form-control form-control-sm mr-2 custom-search-input"
                            type="search"
                            name="s"
                            placeholder="Search"
                            value="<?php echo get_search_query(); ?>"
                            aria-label="Search" required>
                        <button class="btn btn-sm custom-search-btn" type="submit">Submit</button>
                    </form>
                </li>
            </ul>

            <!-- Khu vực bên phải: Menu, Icons, Dropdown Account -->
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Thể thao</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Khoa học</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Tin tức</a></li>

                <!-- Icon 3 chấm: Menu -->
                <li class="nav-item">
                    <a class="header-icon-link" href="#">
                        <i class="fa-solid fa-ellipsis"></i>
                        <small>Menu</small>
                    </a>
                </li>

                <!-- Icon Kính lúp: Search -->
                <li class="nav-item">
                    <a class="header-icon-link" href="#">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <small>Search</small>
                    </a>
                </li>

                <!-- Dropdown Account -->
                <li class="nav-item dropdown ml-3">
                    <a class="nav-link dropdown-toggle text-dark d-flex align-items-center" href="#" id="accountMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-regular fa-circle-user fa-lg mr-1 text-secondary"></i> Account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="accountMenu">
                        <a class="dropdown-item" href="<?php echo wp_login_url(); ?>">Đăng nhập</a>
                        <a class="dropdown-item" href="<?php echo wp_registration_url(); ?>">Đăng ký</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo admin_url('profile.php'); ?>">Hồ sơ cá nhân</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>