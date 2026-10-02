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

    // Hỗ trợ Custom Logo từ Database
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ));

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
    // Nạp Google Font Lexend chuẩn hình mẫu Báo Mới (SV: Huỳnh Anh Tú)
    wp_enqueue_style('google-font-lexend', 'https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&display=swap', array(), null);

    // Nạp file style.css của theme (version 3.3 chống cache)
    wp_enqueue_style('nhom-a-main-style', get_stylesheet_uri(), array('google-font-lexend'), '3.3');

    // Nạp style.css của module widget_test_4 (Bất động sản)
    if (file_exists(get_template_directory() . '/widget_test_4/style.css')) {
        wp_enqueue_style('widget_test_4-style', get_template_directory_uri() . '/widget_test_4/style.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'nhom_a_enqueue_scripts');

/**
 * Đăng ký các Sidebar phía trên Footer:
 * 1. above-footer-sidebar: Dành cho widget BDS
 * 2. widget_test_4: Dành cho widget Báo Mới (Huỳnh Anh Tú)
 */
function nhom_a_register_sidebars()
{
    register_sidebar(array(
        'name'          => 'Above Footer Sidebar (Khu vực trên Footer - BĐS)',
        'id'            => 'above-footer-sidebar',
        'description'   => 'Khu vực hiển thị widget Bất Động Sản phía trên Footer',
        'before_widget' => '<div id="%1$s" class="above-footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'nhom_a_register_sidebars');

/**
 * Cấu hình kết quả tìm kiếm: chỉ tìm trong bài viết thật (post) và sắp xếp theo ngày mới nhất trước
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
 * Đăng ký Shortcode [module_11_archive] và [module_11]
 */
function nhom_a_module_11_shortcode($atts)
{
    ob_start();
    $module11_file = get_template_directory() . '/module11/module11.php';
    if (file_exists($module11_file)) {
        include $module11_file;
    }
    return ob_get_clean();
}
add_shortcode('module_11_archive', 'nhom_a_module_11_shortcode');
add_shortcode('module_11', 'nhom_a_module_11_shortcode');

/**
 * Đăng ký Shortcode [module_12_comments] và [module_12]
 */
function nhom_a_module_12_shortcode($atts)
{
    ob_start();
    $module12_file = get_template_directory() . '/module12/module12.php';
    if (file_exists($module12_file)) {
        include $module12_file;
    }
    return ob_get_clean();
}
add_shortcode('module_12_comments', 'nhom_a_module_12_shortcode');
add_shortcode('module_12', 'nhom_a_module_12_shortcode');

/**
 * Đăng ký Shortcode [module_13_pages] và [module_13]
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

    // Widget Area: Phía trên Footer (Widget Test 4)
    register_sidebar(array(
        'name'          => 'Above Footer (Widget Test 4)',
        'id'            => 'above-footer',
        'description'   => 'Khu vực phía trên Footer - Hiển thị Widget Test 4 (Tin chuyên mục)',
        'before_widget' => '<div id="%1$s" class="widget %2$s wt4-above-footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Đăng ký Widget Test 4
    $wt4_file = get_template_directory() . '/widget_test_4/widget_test_4.php';
    if (file_exists($wt4_file)) {
        require_once $wt4_file;
        if (class_exists('Widget_Test_4')) {
            register_widget('Widget_Test_4');
        }
    }
}
add_action('widgets_init', 'nhom_a_widgets_init');

/**
 * Đăng ký Shortcode [module_16_quick_links] và [module_16]
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

/**
 * Nạp Module: Widget_Test_4_BDS (Bất động sản)
 */
if (file_exists(get_template_directory() . '/widget_test_4/index.php')) {
    require_once get_template_directory() . '/widget_test_4/index.php';
}

/**
 * Nạp Widget Kiểm tra lần 4: Widget_Test_4 (Báo Mới - SV: Huỳnh Anh Tú)
 */
if (file_exists(get_template_directory() . '/widget-class.php')) {
    require_once get_template_directory() . '/widget-class.php';
} elseif (file_exists(get_theme_root() . '/widget_test_4/widget-class.php')) {
    require_once get_theme_root() . '/widget_test_4/widget-class.php';
}

/**
 * Nạp Widget Kiểm tra lần 4: Widget_Test_4_ThietBi (Chuyên mục Thiết bị - Bùi Nguyễn Minh Quân)
 */
if (file_exists(get_template_directory() . '/widget_test_4/widget_test_4.php')) {
    require_once get_template_directory() . '/widget_test_4/widget_test_4.php';
}
