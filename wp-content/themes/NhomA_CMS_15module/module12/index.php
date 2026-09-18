<?php
/**
 * Module 12 Preview & Standalone Runner
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân - Module 12 (Comments)
 */

// Tải môi trường WordPress nếu đã cấu hình (có wp-config.php)
$wp_config_path = dirname(__DIR__, 4) . '/wp-config.php';
$wp_load_path   = dirname(__DIR__, 4) . '/wp-load.php';
if (file_exists($wp_config_path) && file_exists($wp_load_path)) {
    require_once $wp_load_path;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Module 12: Recent Comments - FIT TDC</title>
    <!-- CSS riêng của Module 12 -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f1f5f9;
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
            max-width: 380px;
        }
        .demo-badge {
            text-align: center;
            margin-bottom: 20px;
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="demo-container">
    <div class="demo-badge">
        <strong>Nhóm A CMS &bull; Module 12 (Recent Comments)</strong>
    </div>

    <!-- Nhúng Module 12 -->
    <?php include __DIR__ . '/module12.php'; ?>
</div>

</body>
</html>
