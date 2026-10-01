<?php
/**
 * Setup Script for Module 14 - Comments (TDC FIT)
 * Chức năng: Xóa bình luận mặc định và gieo dữ liệu 3 bình luận mẫu (John Doe, Jane Doe nested, John Doe)
 * theo đúng 100% hình ảnh yêu cầu của Giảng viên.
 */

// Đảm bảo nạp WordPress
if (!defined('ABSPATH')) {
    require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/wp-load.php';
}

$post_id = 1; // Bài viết mặc định "Hello world!"
$post = get_post($post_id);

if (!$post) {
    echo "Post ID $post_id not found. Creating a test post...\n";
    $post_id = wp_insert_post([
        'post_title'   => 'Hello world!',
        'post_name'    => 'hello-world',
        'post_content' => 'Chào mừng bạn đến với WordPress. Đây là bài viết đầu tiên của bạn để kiểm thử Module 14 (Comments).',
        'post_status'  => 'publish',
        'post_type'    => 'post',
        'comment_status' => 'open',
    ]);
} else {
    // Mở bình luận cho post nếu đang đóng
    wp_update_post([
        'ID' => $post_id,
        'comment_status' => 'open'
    ]);
}

// 1. Xóa bình luận mặc định "A WordPress Commenter"
$existing_comments = get_comments(['post_id' => $post_id]);
foreach ($existing_comments as $c) {
    wp_delete_comment($c->comment_ID, true);
}
echo "Cleaned existing comments for post #$post_id.\n";

$lorem = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

// 2. Bình luận 1: John Doe (Cấp cha)
$comment_1_id = wp_insert_comment([
    'comment_post_ID'      => $post_id,
    'comment_author'       => 'John Doe',
    'comment_author_email' => 'johndoe@example.com',
    'comment_content'      => $lorem,
    'comment_parent'       => 0,
    'comment_approved'     => 1,
    'comment_date'         => date('Y-m-d H:i:s', strtotime('-2 hours')),
]);
echo "Created comment 1 (John Doe, ID: $comment_1_id)\n";

// 3. Bình luận 2: Jane Doe (Phản hồi con của John Doe - Nested reply)
$comment_2_id = wp_insert_comment([
    'comment_post_ID'      => $post_id,
    'comment_author'       => 'Jane Doe',
    'comment_author_email' => 'janedoe@example.com',
    'comment_content'      => $lorem,
    'comment_parent'       => $comment_1_id,
    'comment_approved'     => 1,
    'comment_date'         => date('Y-m-d H:i:s', strtotime('-1 hour')),
]);
echo "Created comment 2 (Jane Doe nested reply, ID: $comment_2_id)\n";

// 4. Bình luận 3: John Doe (Cấp cha độc lập)
$comment_3_id = wp_insert_comment([
    'comment_post_ID'      => $post_id,
    'comment_author'       => 'John Doe',
    'comment_author_email' => 'johndoe2@example.com',
    'comment_content'      => $lorem,
    'comment_parent'       => 0,
    'comment_approved'     => 1,
    'comment_date'         => date('Y-m-d H:i:s', strtotime('-30 minutes')),
]);
echo "Created comment 3 (John Doe, ID: $comment_3_id)\n";

// Cập nhật số lượng bình luận cho post
wp_update_comment_count_now($post_id);

echo "Setup Module 14 comments completed successfully!\n";
