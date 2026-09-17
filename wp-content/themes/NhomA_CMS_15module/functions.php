<?php

/**
 * Theme Functions - NhomA_CMS_15module
 */

function nhom_a_theme_setup()
{
    // Hỗ trợ thẻ title tự động
    add_theme_support('title-tag');

    // Hỗ trợ ảnh đại diện (Featured Image) cho bài viết và trang
    add_theme_support('post-thumbnails');

    // Bật hỗ trợ excerpt (tóm tắt) cho Page
    add_post_type_support('page', 'excerpt');

    // Định nghĩa kích thước ảnh thumbnail phù hợp cho card tin tức & module
    add_image_size('news-thumb', 300, 180, true);
    add_image_size('module-13-thumb', 600, 340, true);
}
add_action('after_setup_theme', 'nhom_a_theme_setup');

function nhom_a_enqueue_scripts()
{
    // Nạp file style.css của theme
    wp_enqueue_style('nhom-a-main-style', get_stylesheet_uri(), array(), '1.0');
}
add_action('wp_enqueue_scripts', 'nhom_a_enqueue_scripts');

/**
 * Đăng ký Shortcode [module_13_pages] và [module_13]
 * Cho phép chèn Module 13 vào bất kỳ bài viết hoặc trang nào
 */
function nhom_a_module_13_shortcode($atts)
{
    ob_start();
    $module13_file = get_template_directory() . '/13/test.php';
    if (file_exists($module13_file)) {
        include $module13_file;
    }
    return ob_get_clean();
}
add_shortcode('module_13_pages', 'nhom_a_module_13_shortcode');
add_shortcode('module_13', 'nhom_a_module_13_shortcode');
