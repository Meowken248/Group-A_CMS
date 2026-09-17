<?php

/**
 * Template Name: Search Page
 * Chức năng: Gọi trực tiếp code từ thư mục "Module 5/test.php" của bạn
 */

get_header();

// Nạp file code của bạn từ thư mục "Module 5/test.php"
include get_template_directory() . '/Module 5/test.php';
// Nạp file code của bạn từ thư mục "Module 5/search.php"
include get_template_directory() . '/Module 5/search.php';

get_footer();
