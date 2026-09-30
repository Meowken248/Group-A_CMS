<?php
/**
 * ==========================================================
 * MODULE 15: LAST POSTS (BÀI VIẾT MỚI NHẤT - LATEST NEWS)
 * Đường dẫn: C:\Users\Admin\source\Group-A_CMS\wp-content\themes\NhomA_CMS_15module\15\test.php
 * Thiết kế chuẩn giao diện tin tức / chuyên mục FIT - Cao đẳng Công nghệ Thủ Đức (TDC)
 * Nguồn cảm hứng: Bootsnipp Simple Vertical Timeline (xrKXW)
 * 
 * YÊU CẦU ĐỀ BÀI:
 * - Trước chỉnh sửa: Widget mặc định của WordPress hiển thị tiêu đề "Bài viết mới nhất" với danh sách text thô.
 * - Sau chỉnh sửa:
 *   + Tiêu đề: "Latest News"
 *   + Giao diện Timeline dọc (Simple Vertical Timeline) với các chấm tròn rỗng màu xanh cyan/blue
 *   + Tiêu đề bài viết kèm liên kết (Link)
 *   + Thời gian đăng bài (Date) canh lề bên phải (Float right)
 *   + Tóm tắt nội dung bài viết (Excerpt)
 * ==========================================================
 */

// Truy vấn các bài viết mới nhất từ WordPress
$module15_args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 5,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$module15_query = new WP_Query($module15_args);

// Dữ liệu mẫu dự phòng (Fallback) đúng chuẩn theo ảnh đề bài PDF
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
    .module-15-wrapper {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        max-width: 1140px;
        margin: 20px auto;
    }

    .module-15-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 30px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .module-15-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf2f7;
    }

    /* Simple Vertical Timeline (Chuẩn Bootsnipp xrKXW) */
    ul.timeline-module-15 {
        list-style-type: none;
        position: relative;
        padding-left: 30px;
        margin: 0;
    }

    ul.timeline-module-15:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 9px;
        width: 2px;
        top: 5px;
        bottom: 15px;
        z-index: 10;
    }

    ul.timeline-module-15 > li {
        margin: 25px 0;
        padding-left: 20px;
        position: relative;
    }

    ul.timeline-module-15 > li:first-child {
        margin-top: 10px;
    }

    ul.timeline-module-15 > li:last-child {
        margin-bottom: 10px;
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
        top: 3px;
        z-index: 20;
        transition: border-color 0.2s ease, transform 0.2s ease;
    }

    ul.timeline-module-15 > li:hover:before {
        border-color: #005baa;
        transform: scale(1.15);
    }

    /* Tiêu đề bài viết */
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

    /* Ngày tháng canh phải */
    .module-15-post-date {
        float: right;
        color: #22c0e8;
        font-size: 13.5px;
        font-weight: 500;
    }

    /* Đoạn tóm tắt bài viết */
    .module-15-post-excerpt {
        font-size: 14px;
        color: #64748b;
        line-height: 1.65;
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

        .module-15-container {
            padding: 20px 15px;
        }
    }
</style>

<div class="module-15-wrapper">
    <div class="module-15-container">
        <!-- TIÊU ĐỀ THEO ĐÚNG MẪU: Latest News -->
        <h2 class="module-15-title">Latest News</h2>

        <ul class="timeline-module-15">
            <?php if ($module15_query->have_posts()) : ?>
                <?php while ($module15_query->have_posts()) : $module15_query->the_post(); 
                    $excerpt = get_the_excerpt();
                    if (empty($excerpt)) {
                        $excerpt = wp_trim_words(get_the_content(), 30, '...');
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
                <!-- DỮ LIỆU DỰ PHÒNG NẾU CHƯA CÓ BÀI VIẾT TRONG CSDL -->
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
</div>
