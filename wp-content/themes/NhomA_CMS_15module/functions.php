<?php

/**
 * Theme Functions - NhomA_CMS_15module
 */

function nhom_a_theme_setup()
{
    // Hỗ trợ thẻ title tự động
    add_theme_support('title-tag');

    // Hỗ trợ ảnh đại diện (Featured Image) cho bài viết
    add_theme_support('post-thumbnails');

    // Định nghĩa kích thước ảnh thumbnail phù hợp cho card tin tức
    add_image_size('news-thumb', 300, 180, true);
}
add_action('after_setup_theme', 'nhom_a_theme_setup');

function nhom_a_enqueue_scripts()
{
    // Nạp file style.css của theme
    wp_enqueue_style('nhom-a-main-style', get_stylesheet_uri(), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'nhom_a_enqueue_scripts');

/**
 * Cấu hình kết quả tìm kiếm: chỉ tìm trong bài viết (post) và sắp xếp theo ngày mới nhất trước
 */
function nhom_a_search_filter($query)
{
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'nhom_a_search_filter');
