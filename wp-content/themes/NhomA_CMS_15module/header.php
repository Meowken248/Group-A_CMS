<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <!-- Google Fonts: Lexend (Chuẩn hình mẫu Báo Mới - SV: Huỳnh Anh Tú) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap">

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- File style.css của Theme -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>?v=<?php echo (defined('WP_DEBUG') && WP_DEBUG) ? time() : '3.3'; ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- HEADER / NAVBAR MODULE (MODULE 1) -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <!-- Tên nhóm / Logo lấy trực tiếp từ Database -->
        <?php if (function_exists('has_custom_logo') && has_custom_logo()) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <a class="navbar-brand font-weight-bold mr-4 text-dark" href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo esc_html(get_bloginfo('name') ? get_bloginfo('name') : 'Nhóm A'); ?>
            </a>
        <?php endif; ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!-- Khu vực bên trái: Nút Home + Form Search thật điều hướng WordPress -->
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-secondary px-3 font-weight-bold" href="<?php echo esc_url(home_url('/')); ?>">Home</a>
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

            <!-- Khu vực bên phải: Chuyên mục, Menu, Icons, Dropdown Account -->
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="<?php echo esc_url(home_url('/')); ?>">Thể thao</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="<?php echo esc_url(home_url('/')); ?>">Khoa học</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="<?php echo esc_url(home_url('/')); ?>">Tin tức</a></li>

                <!-- Icon 3 chấm: Menu -->
                <li class="nav-item">
                    <a class="header-icon-link" href="#">
                        <i class="fa-solid fa-ellipsis"></i>
                        <small>Menu</small>
                    </a>
                </li>

                <!-- Icon Kính lúp: Search -->
                <li class="nav-item">
                    <a class="header-icon-link" href="<?php echo esc_url(home_url('/?s=')); ?>">
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

    <!-- KHU VỰC NỘI DUNG CHÍNH (MAIN CONTENT) -->
    <main id="site-main" class="site-main py-4">
        <div class="container-fluid site-container">