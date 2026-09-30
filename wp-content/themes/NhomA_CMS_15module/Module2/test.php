<?php

/**
 * ==========================================================
 * MODULE 2: CONTENT (DANH SÁCH BÀI VIẾT TIN TỨC)
 * Dự án: Group-A CMS (15 Modules) - Khoa CNTT FIT-TDC
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module2/test.php
 * Thiết kế chuẩn giao diện tin tức FIT - Cao đẳng Công nghệ Thủ Đức (http://fit.tdc.edu.vn)
 * Tích hợp tính năng chống tràn chữ (overflow-wrap) và chống bể khung hình ảnh
 * ==========================================================
 */

// Tự động nạp môi trường WordPress nếu người dùng mở trực tiếp test.php trên trình duyệt
if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

$is_standalone = !did_action('get_header');
if ($is_standalone && function_exists('get_header')) {
    get_header();
}
?>

<!-- Định kiểu CSS riêng cho Module 2: Content -->
<style>
    /* 1. Khung chứa chính của Module 2 */
    .module-2-content-container {
        max-width: 1140px;
        margin: 30px auto;
        padding: 0 15px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        box-sizing: border-box;
    }

    /* 2. Danh sách bài viết */
    .fit-posts-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
        width: 100%;
    }

    /* 3. Thẻ tin tức ngang (Card) */
    .fit-post-card {
        display: flex;
        align-items: stretch;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 16px 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        transition: all 0.25s ease-in-out;
        overflow: hidden;
        width: 100%;
        box-sizing: border-box;
    }

    .fit-post-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        transform: translateY(-1px);
    }

    /* 4. Cột 1: Khối Ngày - Tháng (Date Badge) */
    .fit-date-box {
        flex: 0 0 95px;
        width: 95px;
        min-width: 95px;
        max-width: 95px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        text-align: center;
        padding-right: 18px;
        margin-right: 20px;
        border-right: 1px solid #e2e8f0;
        flex-shrink: 0;
        user-select: none;
        align-self: stretch;
        padding-top: 2px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .fit-date-box .fit-date-day {
        font-size: 34px;
        font-weight: 700;
        line-height: 1;
        color: #1e293b;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
        white-space: nowrap;
        text-align: center;
    }

    .fit-date-box .fit-date-month {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        text-align: center;
        display: block;
    }

    /* Cột Ảnh đại diện (Thumbnail) nếu có */
    .fit-post-thumb {
        flex: 0 0 180px;
        width: 180px;
        max-width: 180px;
        height: 120px;
        margin-right: 20px;
        overflow: hidden;
        border-radius: 4px;
        background-color: #f1f5f9;
        flex-shrink: 0;
        align-self: flex-start;
    }

    .fit-post-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .fit-post-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.25s ease;
    }

    .fit-post-card:hover .fit-post-thumb img {
        transform: scale(1.05);
    }

    /* 5. Cột 2: Tiêu đề & Tóm tắt bài viết */
    .fit-post-content {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        word-wrap: break-word;
        overflow-wrap: anywhere;
        word-break: break-word;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .fit-post-title {
        font-size: 15.5px;
        font-weight: 700;
        line-height: 1.45;
        text-transform: uppercase;
        margin: 0 0 8px 0;
        overflow-wrap: anywhere;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-post-title a {
        color: #005baa; /* Mã màu xanh đặc trưng FIT-TDC */
        text-decoration: none;
        transition: color 0.2s ease;
        overflow-wrap: anywhere;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-post-title a:hover {
        color: #003e75;
        text-decoration: none;
    }

    .fit-post-excerpt {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.6;
        margin: 0;
        overflow-wrap: anywhere;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-post-excerpt p {
        margin: 0;
        display: inline;
        overflow-wrap: anywhere;
        word-wrap: break-word;
        word-break: break-word;
    }

    /* Đảm bảo toàn bộ hình ảnh trong bài viết không bị bể khung hoặc tràn ra ngoài */
    .fit-post-card img,
    .fit-post-content img,
    .fit-post-excerpt img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* 6. Trạng thái khi chưa có bài viết */
    .fit-posts-empty {
        background: #ffffff;
        padding: 40px 20px;
        text-align: center;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        color: #64748b;
        font-size: 15px;
    }

    /* 7. Phân trang */
    .fit-pagination {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 4px;
    }

    .fit-pagination .page-numbers {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        margin: 0 2px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        color: #005baa;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .fit-pagination .page-numbers:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .fit-pagination .page-numbers.current {
        background: #005baa;
        color: #ffffff;
        border-color: #005baa;
    }

    /* 8. Responsive trên thiết bị di động */
    @media (max-width: 768px) {
        .fit-post-card {
            flex-direction: column;
            align-items: stretch;
            padding: 16px;
        }

        .fit-date-box {
            flex: none;
            flex-direction: row;
            align-items: center;
            width: 100%;
            min-width: 0;
            max-width: 100%;
            justify-content: flex-start;
            gap: 12px;
            padding-right: 0;
            padding-top: 0;
            margin-right: 0;
            padding-bottom: 10px;
            margin-bottom: 12px;
            border-right: none;
            border-bottom: 1px solid #e2e8f0;
            align-self: auto;
        }

        .fit-date-box .fit-date-day {
            font-size: 26px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .fit-date-box .fit-date-month {
            font-size: 12px;
            white-space: nowrap;
        }

        .fit-post-thumb {
            width: 100%;
            max-width: 100%;
            height: 180px;
            margin-right: 0;
            margin-bottom: 12px;
        }
    }
</style>

<div class="module-2-content-container">
    <div class="fit-posts-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $post = get_post();

                // Lấy ngày đăng dạng 2 chữ số (ví dụ: 07, 03, 24)
                $post_day = get_the_date('d', $post->ID);

                // Lấy tháng đăng dạng 2 chữ số (ví dụ: 10, 09)
                $post_month = get_the_date('m', $post->ID);
                ?>

                <article class="fit-post-card">
                    <!-- CỘT 1: KHỐI NGÀY - THÁNG (DATE BADGE) -->
                    <div class="fit-date-box">
                        <span class="fit-date-day"><?php echo esc_html($post_day); ?></span>
                        <span class="fit-date-month">THÁNG <?php echo esc_html($post_month); ?></span>
                    </div>

                    <!-- CỘT ẢNH ĐẠI DIỆN (NẾU CÓ FEATURED IMAGE) -->
                    <?php if (has_post_thumbnail($post->ID)) : ?>
                        <div class="fit-post-thumb">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php echo get_the_post_thumbnail($post->ID, 'medium', array('class' => 'fit-post-img', 'alt' => get_the_title())); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- CỘT 2: TIÊU ĐỀ & TÓM TẮT BÀI VIẾT -->
                    <div class="fit-post-content">
                        <h3 class="fit-post-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="fit-post-excerpt">
                            <?php
                            $excerpt = get_the_excerpt();
                            if (!empty($excerpt)) {
                                echo wp_kses_post(wp_trim_words($excerpt, 35, '...'));
                            } else {
                                echo esc_html(wp_trim_words(get_the_content(), 35, '...'));
                            }
                            ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Phân trang -->
            <div class="fit-pagination">
                <?php the_posts_pagination(array(
                    'prev_text' => '&laquo; Trước',
                    'next_text' => 'Sau &raquo;',
                )); ?>
            </div>

        <?php else : ?>
            <div class="fit-posts-empty">
                <p>Hiện tại chưa có bài viết nào được đăng tải.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
if ($is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
