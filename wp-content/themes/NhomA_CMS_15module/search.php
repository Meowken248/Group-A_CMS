<?php

/**
 * Template Name: Search Page
 * Chức năng: Gọi trực tiếp code từ thư mục "Module 5/test.php" của bạn
 */

get_header();

if (have_posts()) {
    // Nếu có bài viết phù hợp: Hiển thị Module 5 (Danh sách bài viết)
    include get_template_directory() . '/Module 5/test.php';
} else {
    // Nếu không tìm thấy bài viết: Hiển thị Module 4 (Giao diện Bootsnipp 35V6b chuẩn Hình 2)
    include get_template_directory() . '/Moudle4/test.php';
}

<!-- WIDGET TEST 4: Phía trên Footer (Trang danh sách) -->
<div class="wt4-above-footer-area">
    <?php
    if (function_exists('is_active_sidebar') && is_active_sidebar('above-footer')) {
        dynamic_sidebar('above-footer');
    } else {
        $wt4_path = get_template_directory() . '/widget_test_4/widget_test_4.php';
        if (file_exists($wt4_path)) {
            include $wt4_path;
            if (function_exists('nhom_a_render_widget_test_4')) {
                nhom_a_render_widget_test_4();
            }
        }
    }
    ?>
</div>

<?php
get_footer();

