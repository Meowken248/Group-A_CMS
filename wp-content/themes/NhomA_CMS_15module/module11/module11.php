<?php

/**
 * Module 11: Archives / Bài viết mới nhất (VnExpress "Xem nhiều" Style)
 * Thiết kế chuẩn xác 100% theo ảnh mẫu Giảng viên yêu cầu:
 * - Tiêu đề "Xem nhiều" màu đen than, không gạch đỏ, không nút tab rườm rà
 * - Bố cục 1 CỘT (danh sách dọc từ 1 đến 8) để cân đối bố cục trang web
 * - Chữ số Serif cỡ lớn (28px - 30px), đậm nét, màu đen tuyền (#111111)
 * - Đường phân cách mỏng giữa các mục
 */

// Khai báo các hàm an toàn khi chạy độc lập ngoài WordPress
if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
    }
}
if (!function_exists('esc_url')) {
    function esc_url($url)
    {
        return htmlspecialchars((string)$url, ENT_QUOTES, 'UTF-8');
    }
}

// Tự động xác định đường dẫn file stylesheet của Module 11 kèm cache busting
$module11_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module11_css_url = get_template_directory_uri() . '/module11/style.css?v=' . (defined('WP_DEBUG') && WP_DEBUG ? time() : '4.0');
} else {
    $module11_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module11') ? 'style.css?v=4.0' : 'module11/style.css?v=4.0';
}

// Lấy dữ liệu bài viết mới nhất từ WordPress (hoặc dữ liệu mẫu chuẩn VnExpress)
$vnexpress_items = array();

if (function_exists('get_posts')) {
    $wp_latest_posts = get_posts(array(
        'numberposts' => 8,
        'post_status' => 'publish',
        'orderby'     => 'date',
        'order'       => 'DESC'
    ));

    if (!empty($wp_latest_posts)) {
        foreach ($wp_latest_posts as $post_obj) {
            $vnexpress_items[] = array(
                'title'         => get_the_title($post_obj->ID),
                'url'           => get_permalink($post_obj->ID),
                'comment_count' => (int) get_comments_number($post_obj->ID),
                'date'          => get_the_date('d/m/Y', $post_obj->ID),
            );
        }
    }
}

// Nếu chưa có bài viết từ database, sử dụng danh sách tin tức mẫu chuẩn
if (empty($vnexpress_items)) {
    $vnexpress_items = array(
        array('title' => 'Lễ ký kết Thỏa thuận Hợp tác Đào tạo và Tiếp nhận Thực tập sinh cùng FPT Software', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Sinh viên FIT-TDC xuất sắc đạt giải cao tại Cuộc thi Olympic Tin học Toàn quốc', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Ngày hội Tuyển dụng và Kết nối Doanh nghiệp IT Job Fair 2021', 'url' => '#', 'comment_count' => 1),
        array('title' => 'Hội thảo Chuyển đổi số và Ứng dụng Trí tuệ Nhân tạo (AI) trong Doanh nghiệp', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Kế hoạch thực tập tốt nghiệp và đồ án chuyên ngành CNTT', 'url' => '#', 'comment_count' => 1),
        array('title' => 'ĐĂNG KÝ THAM GIA LIVESTREAM WORKSHOP BỘ MÔN CÔNG NGHỆ PHẦN MỀM', 'url' => '#', 'comment_count' => 1),
        array('title' => 'LỊCH PHỎNG VẤN CHƯƠNG TRÌNH CNTT NHẬT BẢN 2021', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Truyền thông và Mạng máy tính - Ngành học giàu tiềm năng', 'url' => '#', 'comment_count' => 0),
    );
}
?>

<!-- Nạp CSS riêng của Module 11 -->
<link rel="stylesheet" href="<?php echo esc_url($module11_css_url); ?>">

<div class="module-11-container" id="module-11-box">
    <!-- Tiêu đề Xem nhiều chuẩn xác 100% theo ảnh mẫu -->
    <div class="module-11-header-bar">
        <h3 class="module-11-main-title">Xem nhiều</h3>
    </div>

    <!-- Bố cục 1 CỘT DUY NHẤT từ bài 1 đến bài 8 để cân đối bố cục trang -->
    <div class="module-11-list">
        <?php
        $rank = 1;
        foreach ($vnexpress_items as $item) :
        ?>
            <div class="module-11-item">
                <span class="module-11-number"><?php echo $rank; ?></span>
                <div class="module-11-info">
                    <a href="<?php echo esc_url($item['url']); ?>" class="module-11-post-title">
                        <?php echo esc_html($item['title']); ?>
                    </a>
                    <?php if (!empty($item['comment_count'])) : ?>
                        <span class="module-11-comment-count" title="<?php echo esc_html($item['comment_count']); ?> bình luận">
                            <svg class="module-11-icon-bubble" viewBox="0 0 24 24" width="13" height="13" fill="currentColor">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0-2-.9-2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            <span><?php echo esc_html($item['comment_count']); ?></span>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php
            $rank++;
        endforeach;
        ?>
    </div>
</div>