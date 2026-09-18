<?php
/**
 * ==========================================================
 * MODULE 15: LAST POSTS (BÀI VIẾT MỚI NHẤT - LATEST NEWS)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/15/test.php
 * Thiết kế chuẩn mẫu Bootsnipp Simple Vertical Timeline (xrKXW) theo PDF Trang 12
 * 
 * YÊU CẦU ĐỀ BÀI:
 * - Thay thế widget "Bài viết mới nhất" mặc định dạng văn bản thô của WordPress.
 * - Sau chỉnh sửa:
 *   + Tiêu đề khối: "Latest News"
 *   + Trục Timeline dọc với chấm tròn rỗng viền xanh cyan (#22c0e8) chuẩn Bootsnipp xrKXW
 *   + Tiêu đề bài viết kèm liên kết (Link)
 *   + Thời gian đăng bài (Date) canh phải (float right)
 *   + Đoạn tóm tắt nội dung bài viết (Excerpt)
 * ==========================================================
 */

// Tự động nạp môi trường WordPress nếu người dùng mở trực tiếp test.php
if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

$module15_is_standalone = !did_action('get_header');
if ($module15_is_standalone && function_exists('get_header')) {
    get_header();
}

// Truy vấn các bài viết mới nhất từ WordPress CSDL
$module15_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$module15_query = new WP_Query($module15_args);

// Dữ liệu mẫu dự phòng (Fallback) đúng chuẩn theo ảnh đề bài PDF (New Web Design, 21 000 Job Seekers, Awesome Employers)
$module15_fallbacks = [
    [
        'title'   => 'New Web Design',
        'date'    => '21 March, 2014',
        'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....',
        'link'    => '#',
    ],
    [
        'title'   => '21 000 Job Seekers',
        'date'    => '4 March, 2014',
        'excerpt' => 'Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...',
        'link'    => '#',
    ],
    [
        'title'   => 'Awesome Employers',
        'date'    => '1 April, 2014',
        'excerpt' => 'Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...',
        'link'    => '#',
    ]
];
?>

<!-- Định kiểu CSS riêng cho Module 15 (Bootsnipp xrKXW) -->
<style>
    .module-15-widget {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 28px 30px;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    /* Tiêu đề theo đúng mẫu PDF: Latest News */
    .module-15-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 22px 0;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .module-15-title span.badge-source {
        font-size: 12px;
        font-weight: 500;
        background: #f1f5f9;
        color: #64748b;
        padding: 3px 8px;
        border-radius: 4px;
    }

    /* Trục Timeline dọc (Simple Vertical Timeline) chuẩn Bootsnipp xrKXW */
    ul.timeline-module-15 {
        list-style-type: none;
        position: relative;
        padding-left: 30px;
        margin: 0;
    }

    /* Đường kẻ trục dọc màu xám */
    ul.timeline-module-15:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 9px;
        width: 2px;
        top: 6px;
        bottom: 15px;
        z-index: 10;
    }

    ul.timeline-module-15 > li {
        margin: 22px 0;
        padding-left: 20px;
        position: relative;
    }

    ul.timeline-module-15 > li:first-child {
        margin-top: 5px;
    }

    ul.timeline-module-15 > li:last-child {
        margin-bottom: 5px;
    }

    /* Chấm tròn rỗng màu xanh cyan/blue trên đường kẻ dọc */
    ul.timeline-module-15 > li:before {
        content: ' ';
        background: #ffffff;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: -29px;
        width: 18px;
        height: 18px;
        top: 2px;
        z-index: 20;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    ul.timeline-module-15 > li:hover:before {
        border-color: #005baa;
        transform: scale(1.18);
    }

    /* Tiêu đề bài viết liên kết */
    .module-15-post-title {
        font-size: 16px;
        font-weight: 600;
        color: #005baa;
        text-decoration: none;
        transition: color 0.2s;
    }

    .module-15-post-title:hover {
        color: #d32f2f;
        text-decoration: underline;
    }

    /* Ngày tháng canh phải (float right) */
    .module-15-post-date {
        float: right;
        color: #22c0e8;
        font-size: 13.5px;
        font-weight: 500;
    }

    /* Tóm tắt nội dung bài viết */
    .module-15-post-excerpt {
        font-size: 14px;
        color: #64748b;
        line-height: 1.6;
        margin-top: 8px;
        margin-bottom: 0;
        clear: both;
    }

    @media (max-width: 768px) {
        .module-15-post-date {
            float: none;
            display: block;
            margin-top: 4px;
        }

        .module-15-widget {
            padding: 20px 15px;
        }
    }
</style>

<div class="module-15-widget <?php echo ($module15_is_standalone ? 'container my-4' : ''); ?>">
    <!-- TIÊU ĐỀ THEO ĐÚNG MẪU: Latest News -->
    <h2 class="module-15-title">
        Latest News
        <span class="badge-source">Bootsnipp xrKXW</span>
    </h2>

    <ul class="timeline-module-15">
        <?php if ($module15_query->have_posts()) : ?>
            <?php while ($module15_query->have_posts()) : $module15_query->the_post(); 
                $excerpt = get_the_excerpt();
                if (empty($excerpt)) {
                    $excerpt = wp_trim_words(get_the_content(), 28, '...');
                }
                if (empty($excerpt)) {
                    $excerpt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare.';
                }
            ?>
                <li>
                    <a href="<?php the_permalink(); ?>" class="module-15-post-title">
                        <?php the_title(); ?>
                    </a>
                    <span class="module-15-post-date">
                        <?php echo get_the_date('j F, Y'); ?>
                    </span>
                    <p class="module-15-post-excerpt">
                        <?php echo esc_html($excerpt); ?>
                    </p>
                </li>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <!-- DỮ LIỆU DỰ PHÒNG CHUẨN ĐÚNG THEO ẢNH ĐỀ BÀI BOOTSNIPP xrKXW -->
            <?php foreach ($module15_fallbacks as $fb) : ?>
                <li>
                    <a href="<?php echo esc_url($fb['link']); ?>" class="module-15-post-title">
                        <?php echo esc_html($fb['title']); ?>
                    </a>
                    <span class="module-15-post-date">
                        <?php echo esc_html($fb['date']); ?>
                    </span>
                    <p class="module-15-post-excerpt">
                        <?php echo esc_html($fb['excerpt']); ?>
                    </p>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<?php
if ($module15_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
