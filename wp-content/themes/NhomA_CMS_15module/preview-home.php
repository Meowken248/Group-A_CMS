<?php
/**
 * Standalone Preview: Trang Chủ (Home Page) 3 Cột
 * Mô phỏng layout index.php chuẩn 100% theo sơ đồ Hình 1:
 * - Header (1)
 * - 3 Cột:
 *   + Cột 1 (Trái): Archive (Module 11) - Widget: footer #1
 *   + Cột 2 (Giữa): Content (2) (Danh sách tin tức FIT TDC)
 *   + Cột 3 (Phải): Comments (Module 12) - Widget: footer #2
 * - Footer (3)
 */

$wp_config_path = dirname(__DIR__, 3) . '/wp-config.php';
$wp_load_path   = dirname(__DIR__, 3) . '/wp-load.php';
if (file_exists($wp_config_path) && file_exists($wp_load_path)) {
    require_once $wp_load_path;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Trang Chủ 3 Cột (Module 11 - Content 2 - Module 12) - Nhóm A CMS</title>

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Style của Theme -->
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #f8fafc;
        }
        .demo-bar {
            background: #1e293b;
            color: #ffffff;
            padding: 10px 20px;
            font-size: 13.5px;
            text-align: center;
        }
        .demo-bar a {
            color: #38bdf8;
            margin: 0 10px;
            text-decoration: underline;
        }
        .col-lg-6 .module-2-content-container {
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
</head>
<body>

<div class="demo-bar">
    <strong>Nhóm A CMS &bull; Sơ đồ Trang Chủ (Hình 1)</strong>:
    <a href="preview-home.php">Trang Chủ (3 cột)</a> |
    <a href="preview-detail.php">Trang Chi Tiết (3 cột: Module 9 & 10)</a> |
    <a href="module11/">Module 11 (Archive)</a> |
    <a href="module12/">Module 12 (Comments)</a>
</div>

<!-- HEADER (MODULE 1) -->
<nav class="navbar navbar-expand-lg navbar-light custom-navbar bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold mr-4 text-dark" href="preview-home.php">Group A CMS</a>
        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-secondary px-3 active font-weight-bold" href="preview-home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Thể thao</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Khoa học</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2" href="#">Tin tức FIT</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT 3 CỘT (HÌNH 1 ĐỀ BÀI) -->
<main class="site-main py-4">
    <div class="container">
        <div class="row">
            <!-- CỘT 1 (TRÁI): ARCHIVE (MODULE 11) - WIDGET: FOOTER #1 -->
            <div class="col-lg-3 col-md-4 mb-4">
                <?php include __DIR__ . '/module11/module11.php'; ?>
            </div>

            <!-- CỘT 2 (GIỮA): CONTENT (2) - BÀI VIẾT TIN TỨC FIT TDC -->
            <div class="col-lg-6 col-md-4 mb-4">
                <?php
                $module2_file = __DIR__ . '/Module2/test.php';
                if (file_exists($module2_file)) {
                    include $module2_file;
                }
                ?>
            </div>

            <!-- CỘT 3 (PHẢI): COMMENTS (MODULE 12) - WIDGET: FOOTER #2 -->
            <div class="col-lg-3 col-md-4 mb-4">
                <?php include __DIR__ . '/module12/module12.php'; ?>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER (MODULE 3) -->
<footer class="site-footer bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> - <strong>Nhóm A CMS (15 Modules)</strong> - Khoa Công Nghệ Thông Tin (FIT TDC).</p>
    </div>
</footer>

</body>
</html>
