<?php
/**
 * Standalone Preview: Trang Chi Tiết (Detail Post) 3 Cột
 * Mô phỏng layout single.php chuẩn 100% theo sơ đồ Hình 3:
 * - Header
 * - 3 Cột:
 *   + Cột 1 (Trái): Categories (Module 9)
 *   + Cột 2 (Giữa): Detail (Module 6) + Prev/Next Post (Module 7) + Comments (Module 8)
 *   + Cột 3 (Phải): Recent post (Module 10)
 * - Footer
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
    <title>Demo Trang Chi Tiết 3 Cột (Module 9 - Detail 6 - Module 10) - Nhóm A CMS</title>

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
    </style>
</head>
<body>

<div class="demo-bar">
    <strong>Nhóm A CMS &bull; Sơ đồ Trang Chi Tiết (Hình 3)</strong>:
    <a href="preview-home.php">Trang Chủ (3 cột: Module 11 & 12)</a> |
    <a href="preview-detail.php">Trang Chi Tiết (3 cột: Module 9 & 10)</a> |
    <a href="module9/">Module 9 (Categories)</a> |
    <a href="module10/">Module 10 (Recent post)</a>
</div>

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light custom-navbar bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand font-weight-bold mr-4 text-dark" href="preview-home.php">Group A CMS</a>
        <div class="collapse navbar-collapse show">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item"><a class="nav-link text-secondary px-3" href="preview-home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-secondary px-2 active font-weight-bold" href="preview-detail.php">Trang Chi Tiết</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT 3 CỘT (HÌNH 3 ĐỀ BÀI) -->
<main class="site-main py-4">
    <div class="container">
        <div class="row">
            <!-- CỘT 1 (TRÁI): CATEGORIES (MODULE 9) -->
            <div class="col-lg-3 col-md-4 mb-4">
                <?php include __DIR__ . '/module9/module9.php'; ?>
            </div>

            <!-- CỘT 2 (GIỮA): DETAIL (MODULE 6) - BÀI VIẾT CHI TIẾT -->
            <div class="col-lg-6 col-md-4 mb-4">
                <!-- DETAIL (MODULE 6) -->
                <article class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px; background: #ffffff;">
                    <h1 class="font-weight-bold text-dark mb-3" style="font-size: 22px; line-height: 1.4;">
                        Sinh viên vượt khó, đạt thành tích nổi bật tại Hội thi Tin học Trẻ
                    </h1>
                    
                    <div class="text-secondary mb-4 pb-3 border-bottom small d-flex flex-wrap align-items-center">
                        <span class="mr-3"><i class="fa-regular fa-calendar mr-1"></i> 13/08/2023</span>
                        <span class="mr-3"><i class="fa-regular fa-user mr-1"></i> Khoa CNTT - FIT TDC</span>
                        <span><i class="fa-regular fa-comment mr-1"></i> 3 bình luận</span>
                    </div>

                    <div class="post-content mb-4" style="line-height: 1.8; font-size: 15px; color: #334155;">
                        <p>Khoa Công nghệ Thông tin - Trường Cao đẳng Công nghệ Thủ Đức (TDC) vừa tuyên dương các bạn sinh viên đạt giải cao trong kỳ thi Olympic Tin học sinh viên và Hội thi tay nghề trẻ vừa qua.</p>
                        <p>Với tinh thần nhiệt huyết, sáng tạo và sự dẫn dắt tận tâm của đội ngũ giảng viên, các bạn đã xuất sắc mang về nhiều giải thưởng danh giá, khẳng định năng lực chuyên môn và vị thế đào tạo công nghệ hàng đầu của FIT TDC.</p>
                        <p>Chương trình đào tạo thực tiễn gắn liền với nhu cầu doanh nghiệp là nền tảng vững chắc giúp sinh viên tự tin bước vào thị trường lao động công nghệ thông tin trong kỷ nguyên số.</p>
                    </div>
                </article>

                <!-- PREV - NEXT POST (MODULE 7) -->
                <div class="card p-3 mb-4 border-0 shadow-sm" style="border-radius: 6px; background-color: #f1f5f9;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap" style="font-size: 13.5px; font-weight: 600;">
                        <div class="prev-post-link my-1">
                            <a href="#" class="text-primary">&laquo; Bài trước: Khai giảng lớp Chuyên đề AI & Cloud</a>
                        </div>
                        <div class="next-post-link my-1">
                            <a href="#" class="text-primary">Livestream Thiết kế đồ họa &raquo;</a>
                        </div>
                    </div>
                </div>

                <!-- COMMENTS (MODULE 8) -->
                <div class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px; background: #ffffff;">
                    <h5 class="font-weight-bold mb-3" style="color: #1e293b;">Bình luận (Comments - Module 8)</h5>
                    <p class="text-muted small">Hãy để lại ý kiến đóng góp của bạn về bài viết này...</p>
                    <form>
                        <div class="form-group mb-3">
                            <textarea class="form-control" rows="3" placeholder="Nhập bình luận của bạn tại đây..."></textarea>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm px-3 font-weight-bold">Gửi bình luận</button>
                    </form>
                </div>
            </div>

            <!-- CỘT 3 (PHẢI): RECENT POST (MODULE 10) -->
            <div class="col-lg-3 col-md-4 mb-4">
                <?php include __DIR__ . '/module10/module10.php'; ?>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER -->
<footer class="site-footer bg-dark text-white py-4 mt-5">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> - <strong>Nhóm A CMS (15 Modules)</strong> - Khoa Công Nghệ Thông Tin (FIT TDC).</p>
    </div>
</footer>

</body>
</html>
