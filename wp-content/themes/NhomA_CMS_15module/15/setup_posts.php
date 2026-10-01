<?php
/**
 * Setup Script for Module 15 - Last posts (TDC FIT)
 * Chức năng: Tạo 3 bài viết mẫu theo đúng ảnh đề bài Bootsnipp xrKXW
 */

// Đảm bảo nạp WordPress
if (!defined('ABSPATH')) {
    require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/wp-load.php';
}

$posts_to_create = [
    [
        'title'   => 'New Web Design',
        'slug'    => 'new-web-design',
        'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....',
        'date'    => '2026-03-21 10:00:00',
    ],
    [
        'title'   => '21 000 Job Seekers',
        'slug'    => '21-000-job-seekers',
        'content' => 'Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...',
        'date'    => '2026-03-04 09:30:00',
    ],
    [
        'title'   => 'Awesome Employers',
        'slug'    => 'awesome-employers',
        'content' => 'Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...',
        'date'    => '2026-04-01 14:15:00',
    ]
];

foreach ($posts_to_create as $p) {
    $existing = get_page_by_path($p['slug'], OBJECT, 'post');
    if (!$existing) {
        $pid = wp_insert_post([
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['content'],
            'post_status'  => 'publish',
            'post_type'    => 'post',
            'post_date'    => $p['date']
        ]);
        echo "Created post: {$p['title']} (ID: $pid)\n";
    } else {
        wp_update_post([
            'ID'           => $existing->ID,
            'post_title'   => $p['title'],
            'post_content' => $p['content'],
            'post_excerpt' => $p['content'],
            'post_status'  => 'publish',
            'post_date'    => $p['date']
        ]);
        echo "Updated post: {$p['title']} (ID: {$existing->ID})\n";
    }
}

echo "Setup Module 15 posts completed successfully!\n";
