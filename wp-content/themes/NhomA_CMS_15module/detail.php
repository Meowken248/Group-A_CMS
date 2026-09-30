<?php

/**
 * Template Name: Detail Template
 * Chức năng: Điều hướng trang chi tiết sang Module 6 (Detail)
 */

get_header();

if (have_posts()) {
    if (file_exists(get_template_directory() . '/Module 6/detail.php')) {
        include get_template_directory() . '/Module 6/detail.php';
    } elseif (file_exists(get_template_directory() . '/Module 6/test.php')) {
        include get_template_directory() . '/Module 6/test.php';
    }
}

get_footer();
