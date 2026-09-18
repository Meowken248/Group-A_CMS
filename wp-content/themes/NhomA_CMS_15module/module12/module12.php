<?php
/**
 * Module 12: Recent Comments Component
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 12
 * Mô tả: Khối hiển thị Bình luận mới nhất (Comments), hỗ trợ Widget footer #2 hoặc chạy độc lập
 */

// Khai báo hàm helper an toàn khi chạy standalone ngoài WordPress
if (!function_exists('esc_html')) {
    function esc_html($text) {
        return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
    }
}
if (!function_exists('esc_url')) {
    function esc_url($url) {
        return htmlspecialchars((string)$url, ENT_QUOTES, 'UTF-8');
    }
}

// Tự động nạp stylesheet của Module 12
$module12_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module12_css_url = get_template_directory_uri() . '/module12/style.css';
} else {
    $module12_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module12') ? 'style.css' : 'module12/style.css';
}
?>

<!-- Nạp CSS riêng biệt của Module 12 -->
<link rel="stylesheet" href="<?php echo esc_url($module12_css_url); ?>">

<div class="module-12-comments-widget">
    <div class="module-12-card">
        <!-- Tiêu đề Comments -->
        <div class="module-12-header">
            <span class="module-12-icon" aria-hidden="true">&#128172;</span>
            <h3 class="module-12-title">Comments</h3>
        </div>

        <!-- Thanh sọc trang trí -->
        <div class="module-12-divider-stripe" aria-hidden="true"></div>

        <!-- Danh sách bình luận -->
        <ul class="module-12-list">
            <?php
            $has_wp_comments = false;
            $recent_comments = array();

            if (function_exists('get_comments')) {
                $recent_comments = get_comments(array(
                    'number'      => 3,
                    'status'      => 'approve',
                    'post_status' => 'publish',
                ));

                if (!empty($recent_comments)) {
                    $has_wp_comments = true;
                }
            }

            if ($has_wp_comments) :
                foreach ($recent_comments as $comment) :
                    $author_name = get_comment_author($comment);
                    $post_title  = get_the_title($comment->comment_post_ID);
                    $post_url    = get_comment_link($comment);
                    $excerpt     = wp_trim_words($comment->comment_content, 12, '...');
                    $date        = get_comment_date('d/m/Y', $comment);
            ?>
                    <li class="module-12-item">
                        <div class="module-12-avatar-box">
                            <?php echo get_avatar($comment, 38); ?>
                        </div>
                        <div class="module-12-content">
                            <div class="module-12-meta">
                                <span class="module-12-author"><?php echo esc_html($author_name); ?></span>
                                <span class="module-12-time"><?php echo esc_html($date); ?></span>
                            </div>
                            <p class="module-12-text">"<?php echo esc_html($excerpt); ?>"</p>
                            <a href="<?php echo esc_url($post_url); ?>" class="module-12-post-link">
                                Trên: <?php echo esc_html($post_title); ?>
                            </a>
                        </div>
                    </li>
            <?php
                endforeach;
            else :
                // Dữ liệu mẫu chuẩn khi chưa có bình luận trong database
                $sample_comments = array(
                    array(
                        'author' => 'Nguyễn Văn An',
                        'time'   => '1 giờ trước',
                        'text'   => 'Bài viết chia sẻ rất bổ ích và thiết thực cho sinh viên IT!',
                        'post'   => 'Sinh viên vượt khó đạt thành tích',
                    ),
                    array(
                        'author' => 'Trần Thị Mai',
                        'time'   => 'Hôm qua',
                        'text'   => 'Mong có thêm nhiều buổi livestream công nghệ như thế này nữa.',
                        'post'   => 'Thiết kế đồ họa - Phác họa tương lai',
                    ),
                    array(
                        'author' => 'Lê Hoàng Phúc',
                        'time'   => '3 ngày trước',
                        'text'   => 'Cảm ơn thầy cô khoa CNTT đã đồng hành và hỗ trợ sinh viên.',
                        'post'   => 'Làm chủ công nghệ cùng Gen Z',
                    ),
                );

                foreach ($sample_comments as $c_item) :
                    $initial = mb_substr($c_item['author'], 0, 1, 'UTF-8');
            ?>
                    <li class="module-12-item">
                        <div class="module-12-avatar-box">
                            <span><?php echo esc_html($initial); ?></span>
                        </div>
                        <div class="module-12-content">
                            <div class="module-12-meta">
                                <span class="module-12-author"><?php echo esc_html($c_item['author']); ?></span>
                                <span class="module-12-time"><?php echo esc_html($c_item['time']); ?></span>
                            </div>
                            <p class="module-12-text">"<?php echo esc_html($c_item['text']); ?>"</p>
                            <a href="#" class="module-12-post-link">
                                Trên: <?php echo esc_html($c_item['post']); ?>
                            </a>
                        </div>
                    </li>
            <?php
                endforeach;
            endif;
            ?>
        </ul>
    </div>
</div>
