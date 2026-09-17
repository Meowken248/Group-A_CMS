<?php

/**
 * Template Name: Search Page
 * Chức năng: Điều hướng trang tìm kiếm
 */

get_header();

if (have_posts()) {
    // Nếu có bài viết phù hợp: Hiển thị Module 5 (Danh sách bài viết)
    if (file_exists(get_template_directory() . '/Module 5/search.php')) {
        include get_template_directory() . '/Module 5/search.php';
    } elseif (file_exists(get_template_directory() . '/Module 5/test.php')) {
        include get_template_directory() . '/Module 5/test.php';
    }
} else {
    // Nếu không tìm thấy bài viết: Hiển thị Module 4 của thành viên (giữ nguyên không đụng vào)
    if (file_exists(get_template_directory() . '/Moudle4/test.php')) {
        include get_template_directory() . '/Moudle4/test.php';
    }
}

get_footer();
