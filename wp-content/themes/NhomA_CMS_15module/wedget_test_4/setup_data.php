<?php
/**
 * Setup Script for Module wedget_test_4 - Báo Thanh Niên Footer
 * Tự động tạo bảng Database và nạp toàn bộ dữ liệu mẫu Báo Thanh Niên
 * 
 * @package NhomA_CMS_15module
 * @subpackage wedget_test_4
 */

// Đảm bảo nạp WordPress
if (!defined('ABSPATH')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

require_once __DIR__ . '/class-thanhnien-db.php';

echo "=== KHỞI TẠO DỮ LIỆU DATABASE CHO MODULE WEDGET_TEST_4 ===\n";

$db = new ThanhNien_Footer_DB();
$db->create_table();
$db->seed_default_data(true);

echo "1. Đã tạo bảng {$db->get_table_name()} thành công.\n";
echo "2. Đã nạp thành công 24 trường dữ liệu mẫu chuẩn Báo Thanh Niên vào Database.\n";
echo "=== HOÀN TẤT ===\n";
