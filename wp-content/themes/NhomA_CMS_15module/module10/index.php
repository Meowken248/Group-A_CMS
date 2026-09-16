<?php
/**
 * Module 10 Preview & Standalone Runner
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân - Module 10 (Recent post)
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
    <title>Demo Module 10: Recent Post - FIT TDC</title>
    <!-- CSS riêng biệt của Module 10 -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #e2e8f0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .demo-container {
            width: 100%;
            max-width: 400px;
        }
        .demo-badge {
            text-align: center;
            margin-bottom: 20px;
            color: #475569;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="demo-container">
    <div class="demo-badge">
        <strong>Nhóm A CMS &bull; Module 10 (Recent Post)</strong>
    </div>

    <!-- Nhúng Module 10 -->
    <?php include __DIR__ . '/module10.php'; ?>
</div>

</body>
</html>
