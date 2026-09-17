<?php

/**
 * =========================================================================
 * MODULE 8: TEST FILE
 * File test độc lập cho Module 8 (Comments)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 8/test.php
 * =========================================================================
 */

// Đảm bảo WordPress context
if (!defined('ABSPATH')) {
    require_once __DIR__ . '/../../../../wp-load.php';
}

// Giả lập user đã đăng nhập (admin) để hiển thị đúng mẫu theo yêu cầu đề bài
if (!is_user_logged_in()) {
    wp_set_current_user(1);
}

// Lấy bài viết đầu tiên để test
if (!have_posts()) {
    query_posts(array(
        'posts_per_page' => 1,
        'post_type'      => 'post',
        'post_status'    => 'publish'
    ));
    if (have_posts()) {
        the_post();
    }
}

// Nạp file chính của Module 8
include __DIR__ . '/comments.php';
