<?php

/**
 * Template Name: Single Post Detail Page
 * Chức năng: Điều hướng trang chi tiết bài viết sang Module 6 (Detail)
 */

get_header();

if (have_posts()) {
    if (file_exists(get_template_directory() . '/Module 6/detail.php')) {
        include get_template_directory() . '/Module 6/detail.php';
    } elseif (file_exists(get_template_directory() . '/Module 6/test.php')) {
        include get_template_directory() . '/Module 6/test.php';
    } elseif (file_exists(get_template_directory() . '/Module 6/single.php')) {
        include get_template_directory() . '/Module 6/single.php';
    }
}

get_footer();
