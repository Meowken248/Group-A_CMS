<?php
/**
 * Module 11: Archives Component
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 11
 * Mô tả: Khối hiển thị Lưu trữ bài viết (Archives) theo tháng/năm, hỗ trợ Widget footer #1 hoặc độc lập
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

// Tự động nạp stylesheet của Module 11
$module11_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module11_css_url = get_template_directory_uri() . '/module11/style.css';
} else {
    $module11_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'module11') ? 'style.css' : 'module11/style.css';
}
?>

<!-- Nạp CSS riêng biệt của Module 11 -->
<link rel="stylesheet" href="<?php echo esc_url($module11_css_url); ?>">

<div class="module-11-archive-widget">
    <div class="module-11-card">
        <!-- Tiêu đề Archives -->
        <div class="module-11-header">
            <span class="module-11-icon" aria-hidden="true">&#128197;</span>
            <h3 class="module-11-title">Archives</h3>
        </div>

        <!-- Thanh sọc trang trí -->
        <div class="module-11-divider-stripe" aria-hidden="true"></div>

        <!-- Danh sách tháng lưu trữ -->
        <ul class="module-11-list">
            <?php
            $has_archives = false;

            if (function_exists('wp_get_archives')) {
                // Lấy danh sách lưu trữ từ WordPress
                $archives_raw = wp_get_archives(array(
                    'type'            => 'monthly',
                    'show_post_count' => true,
                    'echo'            => false,
                    'format'          => 'custom',
                    'before'          => '<li class="module-11-item"><span class="module-11-arrow">&#9656;</span> ',
                    'after'           => '</li>',
                ));

                if (!empty($archives_raw)) {
                    $has_archives = true;
                    // Format lại số lượng thành badge nếu có
                    $archives_formatted = preg_replace(
                        '/\(([0-9]+)\)/',
                        '<span class="module-11-badge">$1</span>',
                        $archives_raw
                    );
                    echo $archives_formatted;
                }
            }

            if (!$has_archives) :
                // Dữ liệu mẫu chuẩn giao diện lưu trữ khi chưa có bài viết thực tế
                $sample_archives = array(
                    array('title' => 'Tháng Tám 2023', 'count' => 12, 'url' => '#'),
                    array('title' => 'Tháng Bảy 2023', 'count' => 8, 'url' => '#'),
                    array('title' => 'Tháng Sáu 2023', 'count' => 15, 'url' => '#'),
                    array('title' => 'Tháng Năm 2023', 'count' => 9, 'url' => '#'),
                    array('title' => 'Tháng Tư 2023', 'count' => 6, 'url' => '#'),
                );

                foreach ($sample_archives as $arch) :
            ?>
                    <li class="module-11-item">
                        <a href="<?php echo esc_url($arch['url']); ?>" class="module-11-link">
                            <span class="module-11-arrow">&#9656;</span>
                            <span><?php echo esc_html($arch['title']); ?></span>
                        </a>
                        <span class="module-11-badge"><?php echo esc_html($arch['count']); ?></span>
                    </li>
            <?php
                endforeach;
            endif;
            ?>
        </ul>
    </div>
</div>
