<?php
/**
 * Module 12: Comments Component (Phong cách el.tdc.edu.vn)
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 12
 * Mô tả: Khối hiển thị Bình luận mới nhất (Comments) chuẩn giao diện el.tdc.edu.vn:
 *        - Tiêu đề "Comments" với đường gạch chân phân cách tinh gọn
 *        - Danh sách bình luận ngăn cách bởi các đường kẻ ngang liền mạch
 *        - Hỗ trợ dữ liệu bình luận thực tế từ WordPress hoặc dữ liệu mẫu chuẩn đề bài
 */

// Khai báo các hàm an toàn khi chạy độc lập ngoài WordPress
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

// Tự động xác định đường dẫn file stylesheet của Module 12
$module12_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module12_css_url = get_template_directory_uri() . '/module12/style.css';
} else {
    $module12_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module12') ? 'style.css' : 'module12/style.css';
}

// Lấy danh sách bình luận đã duyệt từ WordPress
$tdc_comments = array();

if (function_exists('get_comments')) {
    $wp_comments = get_comments(array(
        'number'      => 5,
        'status'      => 'approve',
        'post_status' => 'publish',
    ));

    if (!empty($wp_comments)) {
        foreach ($wp_comments as $c) {
            $post_title = get_the_title($c->comment_post_ID);
            $comment_link = get_comment_link($c);
            $clean_text = wp_strip_all_tags($c->comment_content);
            // Loại bỏ hoàn toàn các văn bản vô nghĩa Lorem Ipsum nếu có trong CSDL
            if (stripos($clean_text, 'Lorem Ipsum') !== false) {
                continue;
            }
            if (mb_strlen($clean_text, 'UTF-8') > 60) {
                $clean_text = mb_substr($clean_text, 0, 57, 'UTF-8') . '...';
            }

            $tdc_comments[] = array(
                'content' => $clean_text,
                'author'  => get_comment_author($c),
                'url'     => $comment_link,
                'post'    => $post_title,
                'date'    => get_comment_date('d/m/Y', $c),
            );
        }
    }
}

// Dữ liệu mẫu chuẩn 100% theo đúng ảnh yêu cầu (el.tdc.edu.vn) khi chưa có bình luận trong database
if (empty($tdc_comments)) {
    $tdc_comments = array(
        array(
            'content' => 'Bài viết hay quá',
            'author'  => 'Sinh viên FIT TDC',
            'url'     => '#',
            'post'    => 'Giới thiệu ngành Công nghệ thông tin',
            'date'    => 'Hôm nay',
        ),
        array(
            'content' => 'Cảm ơn tác giả',
            'author'  => 'Nguyễn Văn Nam',
            'url'     => '#',
            'post'    => 'Thông báo học vụ mới',
            'date'    => 'Hôm qua',
        ),
        array(
            'content' => 'Bài viết thật hữu ích',
            'author'  => 'Trần Thị Mai',
            'url'     => '#',
            'post'    => 'Hướng dẫn đồ án chuyên ngành CMS',
            'date'    => '2 ngày trước',
        ),
    );
}
?>

<!-- Nạp CSS riêng của Module 12 -->
<link rel="stylesheet" href="<?php echo esc_url($module12_css_url); ?>">

<div class="module-12-container" id="module-12-box">
    <!-- Tiêu đề Comments chuẩn el.tdc.edu.vn -->
    <div class="module-12-header">
        <h3 class="module-12-title">Comments</h3>
        <div class="module-12-title-underline" aria-hidden="true"></div>
    </div>

    <!-- Danh sách bình luận dạng tối giản -->
    <ul class="module-12-list">
        <?php foreach ($tdc_comments as $item) : ?>
            <li class="module-12-item">
                <a href="<?php echo esc_url($item['url']); ?>" class="module-12-link" title="<?php echo esc_html($item['author'] . ' - ' . $item['post']); ?>">
                    <?php echo esc_html($item['content']); ?>
                </a>
                <?php if (!empty($item['author']) && $item['author'] !== 'Sinh viên FIT TDC') : ?>
                    <span class="module-12-meta-hint">
                        bởi <?php echo esc_html($item['author']); ?>
                    </span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
