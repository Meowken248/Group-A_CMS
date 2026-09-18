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

get_footer();

