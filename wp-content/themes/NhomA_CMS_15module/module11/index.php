<?php
/**
 * Module 11 Preview & Standalone Runner
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân - Module 11 (VnExpress "Xem nhiều" / Archives)
 */

// Tải môi trường WordPress nếu có
$wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
if (file_exists($wp_load_path)) {
    require_once $wp_load_path;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Module 11: Archives / Bài viết mới nhất (VnExpress Style) - FIT TDC</title>
    <!-- Phông chữ Google Fonts chuẩn Serif VnExpress & Sans-serif -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 40px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }
        .demo-wrapper {
            width: 100%;
            max-width: 820px;
        }
        .demo-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .demo-header h2 {
            margin: 0 0 6px 0;
            font-size: 22px;
            color: #1e293b;
        }
        .demo-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }
        .demo-note-box {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 13px;
            color: #92400e;
        }
    </style>
</head>
<body>

<div class="demo-wrapper">
    <div class="demo-header">
        <h2>Nhóm A CMS &bull; Module 11</h2>
        <p>Giao diện Bài viết mới nhất / Archives phong cách "Xem nhiều" VnExpress</p>
    </div>

    <div class="demo-note-box">
        <strong>Yêu cầu đề bài (GV):</strong> Khối hiển thị số thứ tự lớn từ 1 đến 8 theo mẫu VnExpress. Hỗ trợ chuyển đổi nhanh giữa <em>"Bài viết mới nhất"</em> và <em>"Archives theo ngày tháng"</em>.
    </div>

    <!-- Nhúng Module 11 -->
    <?php include __DIR__ . '/module11.php'; ?>
</div>

</body>
</html>
