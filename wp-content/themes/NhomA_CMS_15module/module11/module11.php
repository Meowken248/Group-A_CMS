<?php

/**
 * Module 11: Archives / Bài viết mới nhất (VnExpress "Xem nhiều" Style)
 * Thiết kế chuẩn xác 100% theo ảnh mẫu Giảng viên yêu cầu:
 * - Tiêu đề "Xem nhiều" màu đen than, không gạch đỏ, không nút tab rườm rà
 * - Bố cục 2 CỘT song song:
 *   + Cột 1 (Trái): Mục 1 đến 4
 *   + Cột 2 (Phải): Mục 5 đến 8
 * - Chữ số Serif cỡ lớn (32px), đậm nét, màu đen tuyền (#111111)
 * - Đường phân cách mỏng giữa các mục trong từng cột
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
    $module11_css_url = get_template_directory_uri() . '/module11/style.css?v=2.0';
} else {
    $module11_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module11') ? 'style.css?v=2.0' : 'module11/style.css?v=2.0';
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

// Nếu chưa có bài viết từ database, sử dụng đúng danh sách tin tức mẫu từ VnExpress trong ảnh yêu cầu
if (empty($vnexpress_items)) {
    $vnexpress_items = array(
        array('title' => 'Việt Nam thua Hàn Quốc 0-6', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Hai nhà thầu nước ngoài từ chối bồi thường vụ cao tốc Đà Nẵng - Quảng Ngãi', 'url' => '#', 'comment_count' => 37),
        array('title' => 'Dự kiến trình Chính phủ nghỉ Tết từ 29/12 Âm lịch', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Israel lắp lồng chống UAV trên nóc xe tăng hiện đại nhất', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Chủ tịch nước Võ Văn Thưởng gặp Tổng thống Putin', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Xem xét đình chỉ Chủ tịch xã liên quan chung cư mini 200 căn hộ', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Mắt 10/10 cũng khó thấy mặt người trong hình', 'url' => '#', 'comment_count' => 0),
        array('title' => 'Mỹ sẵn sàng đưa 2.000 lính phản ứng nhanh tới Israel', 'url' => '#', 'comment_count' => 0),
    );
}

$col1_items = array_slice($vnexpress_items, 0, 4);
$col2_items = array_slice($vnexpress_items, 4, 4);
?>

<!-- Nạp CSS riêng của Module 11 -->
<link rel="stylesheet" href="<?php echo esc_url($module11_css_url); ?>">

<div class="module-11-container" id="module-11-box">
    <!-- Tiêu đề Xem nhiều chuẩn xác 100% theo ảnh mẫu -->
    <div class="module-11-header-bar">
        <h3 class="module-11-main-title">Xem nhiều</h3>
    </div>

    <!-- Bố cục 2 CỘT SONG SONG: Cột 1 (bài 1-4), Cột 2 (bài 5-8) -->
    <div class="module-11-columns-wrap">
        <!-- CỘT 1 (BÀI 1 ĐẾN 4) -->
        <div class="module-11-col">
            <?php
            $rank = 1;
            foreach ($col1_items as $item) :
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

        <!-- CỘT 2 (BÀI 5 ĐẾN 8) -->
        <div class="module-11-col">
            <?php
            $rank = 5;
            foreach ($col2_items as $item) :
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
</div>