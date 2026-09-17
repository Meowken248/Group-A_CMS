<?php
/**
 * The template for displaying comments - NhomA_CMS_15module
 * Nạp trực tiếp giao diện chuẩn từ thư mục 14 (Module 14 - Comments)
 */

if (post_password_required()) {
    return;
}

// Nạp mã nguồn Module 14 từ thư mục 14/test.php
$module14_file = get_template_directory() . '/14/test.php';
if (file_exists($module14_file)) {
    include $module14_file;
}
