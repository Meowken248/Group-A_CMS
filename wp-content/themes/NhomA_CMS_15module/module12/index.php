<?php
/**
 * Module 12 Preview & Standalone Runner
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân - Module 12 (Comments el.tdc.edu.vn)
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
    <title>Demo Module 12: Comments (el.tdc.edu.vn Style) - FIT TDC</title>
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
            max-width: 420px;
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
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 12px 16px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 13px;
            color: #1e40af;
        }
    </style>
</head>
<body>

<div class="demo-wrapper">
    <div class="demo-header">
        <h2>Nhóm A CMS &bull; Module 12</h2>
        <p>Giao diện Khối Comments phong cách el.tdc.edu.vn</p>
    </div>

    <div class="demo-note-box">
        <strong>Yêu cầu đề bài (GV):</strong> Hiển thị tiêu đề Comments có gạch chân, các dòng bình luận phân cách bằng đường line phẳng, hỗ trợ liên kết tới bài viết.
    </div>

    <!-- Nhúng Module 12 -->
    <?php include __DIR__ . '/module12.php'; ?>
</div>

</body>
</html>
