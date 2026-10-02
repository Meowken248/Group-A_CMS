<?php

/**
 * Theme functions and definitions for widget_test_4
 * Bài kiểm tra lần 4 môn CMS - SV: Huỳnh Anh Tú
 */

if (! defined('ABSPATH')) {
    exit;
}

// 1. Cấu hình hỗ trợ Theme
function widget_test_4_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'widget_test_4_setup');

// 2. Nạp file CSS
function widget_test_4_scripts()
{
    wp_enqueue_style('widget-test-4-style', get_stylesheet_uri(), array(), '1.0.1');
}
add_action('wp_enqueue_scripts', 'widget_test_4_scripts');

// 3. Nạp định nghĩa Widget_Test_4 và Sidebar widget_test_4 (Yêu cầu mục #1, #2, #3)
require_once __DIR__ . '/widget-class.php';
