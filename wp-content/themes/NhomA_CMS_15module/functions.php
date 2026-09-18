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
 * Đăng ký các khu vực Widget (Sidebar) cho Theme
 * - Footer #1 (footer-1): Dành cho Module 11 (Archive)
 * - Footer #2 (footer-2): Dành cho Module 12 (Comments)
 */
function nhom_a_widgets_init()
{
    // Widget Footer #1: Module 11 (Archive)
    register_sidebar(array(
        'name'          => 'Footer #1',
        'id'            => 'footer-1',
        'description'   => 'Khu vực Widget Footer #1 - Hiển thị Module 11 (Archive / Lưu trữ bài viết)',
        'before_widget' => '<div id="%1$s" class="widget %2$s module-11-widget-wrap mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Widget Footer #2: Module 12 (Comments)
    register_sidebar(array(
        'name'          => 'Footer #2',
        'id'            => 'footer-2',
        'description'   => 'Khu vực Widget Footer #2 - Hiển thị Module 12 (Recent Comments / Bình luận mới nhất)',
        'before_widget' => '<div id="%1$s" class="widget %2$s module-12-widget-wrap mb-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'nhom_a_widgets_init');



