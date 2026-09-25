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

    // Nạp style.css của module widget_test_4 (Bất động sản)
    if (file_exists(get_template_directory() . '/widget_test_4/style.css')) {
        wp_enqueue_style('widget_test_4-style', get_template_directory_uri() . '/widget_test_4/style.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'nhom_a_enqueue_scripts');

/**
 * Đăng ký Sidebar phía trên Footer cho widget_test_4
 */
function nhom_a_register_sidebars()
{
    register_sidebar(array(
        'name'          => 'Above Footer Sidebar (Khu vực trên Footer)',
        'id'            => 'above-footer-sidebar',
        'description'   => 'Khu vực hiển thị widget_test_4 phía trên Footer',
        'before_widget' => '<div id="%1$s" class="above-footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'nhom_a_register_sidebars');

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

/**
 * Nạp Module: widget_test_4 (Nguyễn Thành Đạt - Bài test 4)
 */
if (file_exists(get_template_directory() . '/widget_test_4/index.php')) {
    require_once get_template_directory() . '/widget_test_4/index.php';
}