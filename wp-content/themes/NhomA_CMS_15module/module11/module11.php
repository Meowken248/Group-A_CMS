<?php
/**
 * Module 11: Archives / Bài viết mới nhất (Phong cách VnExpress "Xem nhiều")
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 11
 * Mô tả: Khối hiển thị Bài viết mới nhất / Lưu trữ ngày tháng phong cách VnExpress:
 *        - Đánh số thứ tự 1-8 nổi bật dạng Big Number Serif
 *        - Hỗ trợ dữ liệu bài viết mới nhất hoặc danh mục lưu trữ theo ngày tháng
 *        - Bố cục 2 cột khi ở khung rộng, tự động thích ứng 1 cột khi nằm trong Sidebar
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

// Tự động xác định đường dẫn file stylesheet của Module 11
$module11_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module11_css_url = get_template_directory_uri() . '/module11/style.css';
} else {
    $module11_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module11') ? 'style.css' : 'module11/style.css';
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
        array(
            'title'         => 'Việt Nam thua Hàn Quốc 0 - 6',
            'url'           => '#',
            'comment_count' => 0,
            'date'          => '17/10/2023',
        ),
        array(
            'title'         => 'Hai nhà thầu nước ngoài từ chối bồi thường vụ cao tốc Đà Nẵng - Quảng Ngãi',
            'url'           => '#',
            'comment_count' => 37,
            'date'          => '17/10/2023',
        ),
        array(
            'title'         => 'Dự kiến trình Chính phủ nghỉ Tết từ 29/12 Âm lịch',
            'url'           => '#',
            'comment_count' => 12,
            'date'          => '16/10/2023',
        ),
        array(
            'title'         => 'Israel lắp lồng chống UAV trên nóc xe tăng hiện đại nhất',
            'url'           => '#',
            'comment_count' => 5,
            'date'          => '16/10/2023',
        ),
        array(
            'title'         => 'Chủ tịch nước Võ Văn Thưởng gặp Tổng thống Putin',
            'url'           => '#',
            'comment_count' => 18,
            'date'          => '17/10/2023',
        ),
        array(
            'title'         => 'Xem xét đình chỉ Chủ tịch xã liên quan chung cư mini 200 căn hộ',
            'url'           => '#',
            'comment_count' => 8,
            'date'          => '16/10/2023',
        ),
        array(
            'title'         => 'Mắt 10/10 cũng khó thấy mặt người trong hình',
            'url'           => '#',
            'comment_count' => 24,
            'date'          => '15/10/2023',
        ),
        array(
            'title'         => 'Mỹ sẵn sàng đưa 2.000 lính phản ứng nhanh tới Israel',
            'url'           => '#',
            'comment_count' => 42,
            'date'          => '16/10/2023',
        ),
    );
}

// Lấy danh sách Archives theo tháng/năm cho tab Archives ngày tháng
$archive_months = array();
if (function_exists('wp_get_archives')) {
    $raw_archives = wp_get_archives(array(
        'type'            => 'monthly',
        'show_post_count' => true,
        'echo'            => false,
        'format'          => 'custom',
        'before'          => '',
        'after'           => '',
    ));
    if (!empty($raw_archives)) {
        preg_match_all('/<a[^>]*href=[\'"]([^\'"]*)[\'"][^>]*>([^<]+)<\/a>(?:&nbsp;|\s)*\(?([0-9]*)\)?/i', $raw_archives, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $archive_months[] = array(
                'title' => trim($m[2]),
                'url'   => $m[1],
                'count' => !empty($m[3]) ? (int)$m[3] : 0,
            );
        }
    }
}
if (empty($archive_months)) {
    $archive_months = array(
        array('title' => 'Tháng Mười 2023 (October 2023)', 'url' => '#', 'count' => 18),
        array('title' => 'Tháng Chín 2023 (September 2023)', 'url' => '#', 'count' => 25),
        array('title' => 'Tháng Tám 2023 (August 2023)', 'url' => '#', 'count' => 14),
        array('title' => 'Tháng Bảy 2023 (July 2023)', 'url' => '#', 'count' => 19),
        array('title' => 'Tháng Sáu 2023 (June 2023)', 'url' => '#', 'count' => 22),
        array('title' => 'Tháng Năm 2023 (May 2023)', 'url' => '#', 'count' => 16),
        array('title' => 'Tháng Tư 2023 (April 2023)', 'url' => '#', 'count' => 11),
        array('title' => 'Tháng Ba 2023 (March 2023)', 'url' => '#', 'count' => 9),
    );
}
?>

<!-- Nạp CSS riêng của Module 11 -->
<link rel="stylesheet" href="<?php echo esc_url($module11_css_url); ?>">

<div class="module-11-container" id="module-11-box">
    <!-- Tiêu đề chuẩn phong cách VnExpress -->
    <div class="module-11-header-bar">
        <h3 class="module-11-main-title">
            <span class="module-11-title-text">Xem nhiều</span>
        </h3>
        <!-- Chuyển đổi linh hoạt giữa Tin mới nhất & Archives ngày tháng theo ghi chú GV -->
        <div class="module-11-tabs" role="tablist">
            <button type="button" class="module-11-tab-btn active" onclick="module11SwitchTab(this, 'posts')">Bài viết mới</button>
            <button type="button" class="module-11-tab-btn" onclick="module11SwitchTab(this, 'archives')">Archives</button>
        </div>
    </div>

    <!-- TAB 1: Danh sách bài viết mới nhất (VnExpress style 1-8) -->
    <div class="module-11-tab-content active" id="module-11-tab-posts">
        <div class="module-11-grid">
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
                                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0-2-.9-2-2V4c0-1.1-.9-2-2-2z"/>
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

    <!-- TAB 2: Danh sách Archives theo ngày tháng phong cách VnExpress -->
    <div class="module-11-tab-content" id="module-11-tab-archives">
        <div class="module-11-grid">
            <?php 
            $arch_rank = 1;
            foreach ($archive_months as $arch) : 
            ?>
                <div class="module-11-item">
                    <span class="module-11-number"><?php echo $arch_rank; ?></span>
                    <div class="module-11-info">
                        <a href="<?php echo esc_url($arch['url']); ?>" class="module-11-post-title">
                            <?php echo esc_html($arch['title']); ?>
                        </a>
                        <span class="module-11-comment-count" title="<?php echo esc_html($arch['count']); ?> bài viết">
                            <span class="module-11-badge-count"><?php echo esc_html($arch['count']); ?> bài</span>
                        </span>
                    </div>
                </div>
            <?php 
                $arch_rank++;
            endforeach; 
            ?>
        </div>
    </div>
</div>

<script>
if (typeof module11SwitchTab === 'undefined') {
    function module11SwitchTab(btn, tabName) {
        var container = btn.closest('.module-11-container');
        if (!container) return;
        
        var buttons = container.querySelectorAll('.module-11-tab-btn');
        buttons.forEach(function(b) { b.classList.remove('active'); });
        btn.classList.add('active');
        
        var titleText = container.querySelector('.module-11-title-text');
        if (titleText) {
            titleText.textContent = (tabName === 'archives') ? 'Archives' : 'Xem nhiều';
        }

        var tabPosts = container.querySelector('#module-11-tab-posts');
        var tabArchives = container.querySelector('#module-11-tab-archives');
        if (tabName === 'archives') {
            if (tabPosts) tabPosts.classList.remove('active');
            if (tabArchives) tabArchives.classList.add('active');
        } else {
            if (tabArchives) tabArchives.classList.remove('active');
            if (tabPosts) tabPosts.classList.add('active');
        }
    }
}
</script>
