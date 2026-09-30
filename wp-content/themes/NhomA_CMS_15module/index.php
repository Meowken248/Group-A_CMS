<?php

/**
 * Index Template - NhomA_CMS_15module
 * Hiển thị giao diện chính tích hợp các Module theo cấu trúc 3 CỘT CHIA ĐỀU CÂN ĐỐI (4 - 4 - 4):
 * - Cột 1 (Trái - col-lg-4): Module 11 (Xem nhiều / Archive 1 cột dọc) từ Widget footer-1
 * - Cột 2 (Giữa - col-lg-4): Content (2) (Danh sách tin tức FIT TDC)
 * - Cột 3 (Phải - col-lg-4): Module 12 (Comments / Bình luận mới nhất) từ Widget footer-2
 */

get_header();
?>

<div class="row">
    <!-- CỘT 1: MODULE 11 - XEM NHIỀU (Chia đều 1/3 bố cục: col-lg-4 col-md-4) -->
    <div class="col-lg-4 col-md-4 mb-4">
        <?php
        if (function_exists('is_active_sidebar') && is_active_sidebar('footer-1')) {
            dynamic_sidebar('footer-1');
        } else {
            $module11_path = get_template_directory() . '/module11/module11.php';
            if (file_exists($module11_path)) {
                include $module11_path;
            }
        }
        ?>
    </div>

    <!-- CỘT 2: CONTENT (2) - TIN TỨC FIT TDC (Chia đều 1/3 bố cục: col-lg-4 col-md-4) -->
    <div class="col-lg-4 col-md-4 mb-4">
        <style>
            /* Tinh chỉnh Module 2 tương thích hoàn hảo trong bố cục 3 cột chia đều */
            .module-2-content-container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        </style>
        <?php
        $module2_path = get_template_directory() . '/Module2/test.php';
        if (file_exists($module2_path)) {
            include $module2_path;
        }
        ?>
    </div>

    <!-- CỘT 3: MODULE 12 - COMMENTS (Chia đều 1/3 bố cục: col-lg-4 col-md-4) -->
    <div class="col-lg-4 col-md-4 mb-4">
        <?php
        if (function_exists('is_active_sidebar') && is_active_sidebar('footer-2')) {
            dynamic_sidebar('footer-2');
        } else {
            $module12_path = get_template_directory() . '/module12/module12.php';
            if (file_exists($module12_path)) {
                include $module12_path;
            }
        }
        ?>
    </div>
</div>

<?php
get_footer();
