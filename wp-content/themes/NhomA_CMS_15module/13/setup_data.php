<?php
/**
 * Setup Script for Module 13 - Pages (TDC FIT)
 * Chức năng: Tạo dữ liệu mẫu 3 trang đào tạo theo đúng yêu cầu đề bài
 */

// Đảm bảo nạp WordPress
if (!defined('ABSPATH')) {
    require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/wp-load.php';
}

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// 1. Chuyển Sample Page về draft để không chiếm chỗ hiển thị
$sample_page = get_page_by_path('sample-page');
if ($sample_page) {
    wp_update_post([
        'ID' => $sample_page->ID,
        'post_status' => 'draft'
    ]);
    echo "Sample page set to draft.\n";
}

// 2. Danh sách 3 trang theo đúng yêu cầu Module 13
$pages_to_create = [
    [
        'title'   => 'Ngành Công Nghệ Thông Tin',
        'slug'    => 'nganh-cong-nghe-thong-tin',
        'content' => 'Trang bị cho sinh viên kiến thức và kỹ năng để trở thành nhà phát triển phần mềm chuyên nghiệp.',
        'image'   => __DIR__ . '/images/cntt.jpg',
        'order'   => 1
    ],
    [
        'title'   => 'Ngành Truyền Thông & Mạng Máy Tính',
        'slug'    => 'nganh-truyen-thong-mang-may-tinh',
        'content' => 'Sinh viên có khả năng nghiên cứu, thiết kế, phát triển và triển khai các ứng dụng về các công nghệ Mạng máy tính.',
        'image'   => __DIR__ . '/images/mang-may-tinh.jpg',
        'order'   => 2
    ],
    [
        'title'   => 'Ngành Thiết Kế Đồ Hoạ',
        'slug'    => 'nganh-thiet-ke-do-hoa',
        'content' => 'Cung cấp các kiến thức về thiết kế đồ hoạ và công nghệ thông tin đa phương tiện.',
        'image'   => __DIR__ . '/images/thiet-ke-do-hoa.jpg',
        'order'   => 3
    ]
];

foreach ($pages_to_create as $p) {
    $existing = get_page_by_path($p['slug']);
    $post_id = 0;

    if (!$existing) {
        $post_id = wp_insert_post([
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'menu_order'   => $p['order']
        ]);
        echo "Created page: {$p['title']} (ID: $post_id)\n";
    } else {
        $post_id = $existing->ID;
        wp_update_post([
            'ID'           => $post_id,
            'post_title'   => $p['title'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['content'],
            'post_status'  => 'publish',
            'menu_order'   => $p['order']
        ]);
        echo "Updated page: {$p['title']} (ID: $post_id)\n";
    }

    // Gán ảnh đại diện nếu có file ảnh
    if ($post_id && file_exists($p['image']) && !has_post_thumbnail($post_id)) {
        $file_array = [
            'name'     => basename($p['image']),
            'tmp_name' => $p['image']
        ];
        
        // Copy tạm để upload
        $tmp_copy = sys_get_temp_dir() . '/' . basename($p['image']);
        copy($p['image'], $tmp_copy);
        $file_array['tmp_name'] = $tmp_copy;

        $attach_id = media_handle_sideload($file_array, $post_id);
        if (!is_wp_error($attach_id)) {
            set_post_thumbnail($post_id, $attach_id);
            echo "Assigned featured image (ID: $attach_id) to {$p['title']}\n";
        } else {
            echo "Error attaching image: " . $attach_id->get_error_message() . "\n";
        }
    }
}

echo "Setup Module 13 data completed successfully!\n";
