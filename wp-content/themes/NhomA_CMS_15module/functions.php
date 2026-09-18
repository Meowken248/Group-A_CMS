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

/**
 * Đăng ký Shortcode [module_14_comments] và [module_14]
 * Cho phép chèn giao diện Module 14 vào bất kỳ bài viết hoặc trang nào
 */
function nhom_a_module_14_shortcode($atts)
{
    ob_start();
    $module14_file = get_template_directory() . '/14/test.php';
    if (file_exists($module14_file)) {
        include $module14_file;
    }
    return ob_get_clean();
}
add_shortcode('module_14_comments', 'nhom_a_module_14_shortcode');
add_shortcode('module_14', 'nhom_a_module_14_shortcode');

/**
 * Đăng ký Shortcode [module_15_last_posts] và [module_15]
 * Cho phép chèn giao diện Module 15 (Timeline Latest News) vào bất kỳ đâu
 */
function nhom_a_module_15_shortcode($atts)
{
    ob_start();
    $module15_file = get_template_directory() . '/15/test.php';
    if (file_exists($module15_file)) {
        include $module15_file;
    }
    return ob_get_clean();
}
add_shortcode('module_15_last_posts', 'nhom_a_module_15_shortcode');
add_shortcode('module_15', 'nhom_a_module_15_shortcode');

/**
 * ==========================================================
 * MỞ RỘNG GIỚI HẠN NHẬP ĐƯỜNG LINK DÀI & SLUG (URL VALIDATION)
 * ==========================================================
 */
// 1. Cho phép đường dẫn tĩnh (Slug) dài tối đa 1000 ký tự (mặc định WP bị cắt ở 200)
add_filter('wp_unique_post_slug', function($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug) {
    if (!empty($original_slug)) {
        return mb_substr($original_slug, 0, 1000);
    }
    return $slug;
}, 10, 6);

// 2. Cho phép dán URL dài tự do trong nội dung mà không bị filter cắt bớt
add_filter('content_save_pre', function($content) {
    return $content;
});
