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

    // Hỗ trợ widgets
    add_theme_support('widgets');

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
 * Đăng ký Shortcode [module_16_quick_links] và [module_16]
 * Cho phép chèn giao diện Module 16 (Liên kết nhanh & Bản tin) vào bất kỳ đâu
 */
function nhom_a_module_16_shortcode($atts)
{
    ob_start();
    $module16_file = get_template_directory() . '/16/test.php';
    if (file_exists($module16_file)) {
        include $module16_file;
    }
    return ob_get_clean();
}
add_shortcode('module_16_quick_links', 'nhom_a_module_16_shortcode');
add_shortcode('module_16', 'nhom_a_module_16_shortcode');

/**
 * ==========================================================
 * MODULE WEDGET_TEST_4: BÁO THANH NIÊN FOOTER & DATABASE
 * Thực hiện: Lê Anh Tuấn
 * ==========================================================
 */
$widget4_dir = get_template_directory() . '/wedget_test_4';
if (file_exists($widget4_dir . '/class-thanhnien-db.php')) {
    require_once $widget4_dir . '/class-thanhnien-db.php';
    require_once $widget4_dir . '/class-thanhnien-widget.php';
    require_once $widget4_dir . '/class-thanhnien-admin.php';

    // Tự động kiểm tra và khởi tạo Database cho Footer Báo Thanh Niên
    add_action('after_setup_theme', function () {
        $db = new ThanhNien_Footer_DB();
        $db->create_table();
    });

    // Đăng ký Custom Widget & Sidebar phía trên footer
    add_action('widgets_init', function () {
        register_widget('ThanhNien_Footer_Widget');

        register_sidebar(array(
            'name'          => 'Khu vực phía trên Footer (Pre-Footer)',
            'id'            => 'pre-footer-sidebar',
            'description'   => 'Khu vực hiển thị widget phía trên Footer (áp dụng cho Trang chủ, Trang danh sách, Trang chi tiết).',
            'before_widget' => '<div id="%1$s" class="pre-footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title" style="display:none;">',
            'after_title'   => '</h3>',
        ));
    });

    // Khởi tạo trang quản trị trong WP Admin
    if (is_admin()) {
        new ThanhNien_Footer_Admin();
    }
}

/**
 * Đăng ký Shortcode [widget_test_4], [wedget_test_4] và [module_4_footer]
 */
function nhom_a_widget_test_4_shortcode($atts)
{
    ob_start();
    $widget4_file = get_template_directory() . '/wedget_test_4/test.php';
    if (file_exists($widget4_file)) {
        include $widget4_file;
    }
    return ob_get_clean();
}
add_shortcode('widget_test_4', 'nhom_a_widget_test_4_shortcode');
add_shortcode('wedget_test_4', 'nhom_a_widget_test_4_shortcode');
add_shortcode('module_4_footer', 'nhom_a_widget_test_4_shortcode');

/**
 * ==========================================================
 * MỞ RỘNG GIỚI HẠN NHẬP ĐƯỜNG LINK DÀI & SLUG (URL VALIDATION)
 * ==========================================================
 */
// 1. Cho phép đường dẫn tĩnh (Slug) dài tối đa 1000 ký tự (mặc định WP bị cắt ở 200)
add_filter('wp_unique_post_slug', function ($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug) {
    if (!empty($original_slug)) {
        return mb_substr($original_slug, 0, 1000);
    }
    return $slug;
}, 10, 6);

// 2. Cho phép dán URL dài tự do trong nội dung mà không bị filter cắt bớt
add_filter('content_save_pre', function ($content) {
    return $content;
});
