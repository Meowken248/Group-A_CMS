<?php

/**
 * =========================================================================
 * MODULE 5: SEARCH RESULT (KẾT QUẢ TÌM KIẾM)
 * Đường dẫn: C:\Group-A_CMS\wp-content\themes\NhomA_CMS_15module\Module 5\search.php
 * Thiết kế giao diện: Thẻ tin tức ngang theo mẫu Khoa CNTT - TDC (fit.tdc.edu.vn)
 * =========================================================================
 */

if (! defined('ABSPATH')) {
    exit; // Bảo mật: Không cho phép truy cập trực tiếp file
}
?>

<!-- ===================================================
     PHẦN CSS: ĐỊNH DẠNG RIÊNG CHO MODULE 5
     (Tự động áp dụng, không phụ thuộc vào file ngoài)
=================================================== -->
<style>
    /* Khung bao bọc toàn bộ Module 5 */
    .module-5-search-wrapper {
        max-width: 1140px;
        margin: 25px auto;
        padding: 0 15px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        color: #333333;
    }

    /* Tiêu đề kết quả tìm kiếm */
    .module-5-search-heading {
        margin-bottom: 25px;
        padding-bottom: 12px;
        border-bottom: 2px solid #005baa;
    }

    .module-5-search-heading h2 {
        font-size: 20px;
        font-weight: 700;
        color: #005baa;
        text-transform: uppercase;
        margin: 0;
    }

    .module-5-search-heading .search-keyword {
        color: #d32f2f;
    }

    /* Danh sách bài viết */
    .module-5-posts-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    /* Thẻ tin tức ngang (Horizontal Post Card) */
    .module-5-card {
        display: flex;
        align-items: flex-start;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
        padding: 16px;
        gap: 20px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        transition: all 0.25s ease-in-out;
    }

    .module-5-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    /* 1. CỘT TRÁI: ẢNH ĐẠI DIỆN BÀI VIẾT (THUMBNAIL) */
    .module-5-col-thumb {
        flex: 0 0 240px;
        width: 240px;
        height: 145px;
        overflow: hidden;
        border-radius: 4px;
        background-color: #f1f5f9;
    }

    .module-5-col-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .module-5-col-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .module-5-col-thumb:hover img {
        transform: scale(1.05);
    }

    /* 2. CỘT GIỮA: KHỐI NGÀY - THÁNG (DATE BADGE) */
    .module-5-col-date {
        flex: 0 0 85px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 5px 15px 5px 0;
        border-right: 1px solid #edf2f7;
    }

    .module-5-col-date .date-day {
        font-size: 38px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
    }

    .module-5-col-date .date-month {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-top: 6px;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    /* 3. CỘT PHẢI: TIÊU ĐỀ & TÓM TẮT */
    .module-5-col-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .module-5-col-content .post-title {
        margin: 0 0 10px 0;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.45;
        text-transform: uppercase;
    }

    .module-5-col-content .post-title a {
        color: #005baa;
        /* Xanh dương TDC */
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .module-5-col-content .post-title a:hover {
        color: #d32f2f;
        /* Đỏ khi hover */
    }

    .module-5-col-content .post-excerpt {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.6;
    }

    .module-5-col-content .post-excerpt p {
        margin: 0;
    }

    /* Thông báo không tìm thấy kết quả */
    .module-5-no-results {
        background: #ffffff;
        padding: 35px 20px;
        text-align: center;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        color: #64748b;
        font-size: 15px;
    }

    /* Phân trang */
    .module-5-pagination {
        margin-top: 25px;
        text-align: center;
    }

    .module-5-pagination .page-numbers {
        display: inline-block;
        padding: 8px 14px;
        margin: 0 3px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        color: #005baa;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .module-5-pagination .page-numbers.current {
        background: #005baa;
        color: #ffffff;
        border-color: #005baa;
    }

    /* Tương thích màn hình điện thoại (Mobile Responsive) */
    @media (max-width: 768px) {
        .module-5-card {
            flex-direction: column;
        }

        .module-5-col-thumb {
            width: 100%;
            max-width: 100%;
            height: 180px;
        }

        .module-5-col-date {
            flex-direction: row;
            gap: 12px;
            border-right: none;
            border-bottom: 1px solid #edf2f7;
            width: 100%;
            padding-right: 0;
            padding-bottom: 8px;
        }

        .module-5-col-date .date-day {
            font-size: 26px;
        }
    }
</style>

<!-- ===================================================
     PHẦN HTML & PHP: HIỂN THỊ KẾT QUẢ TÌM KIẾM
=================================================== -->
<div class="module-5-search-wrapper">

    <!-- Thanh tiêu đề từ khóa tìm kiếm -->
    <div class="module-5-search-heading">
        <h2>Kết quả tìm kiếm cho: "<span class="search-keyword"><?php echo esc_html(get_search_query()); ?></span>"</h2>
    </div>

    <div class="module-5-posts-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                // ==========================================================
                // ÁP DỤNG ĐOẠN CODE GỢI Ý CỦA GIẢNG VIÊN (FIT TDC)
                // ==========================================================
                $post = get_post();

                // Lấy ngày đăng bài (2 chữ số: 07, 08, 15...)
                $post_date = get_the_date('d', $post->ID);

                // Lấy tháng đăng bài (2 chữ số: 01 -> 12)
                $post_month = get_the_date('m', $post->ID);

                // Các biến theo gợi ý date() & strtotime():
                $sdate  = $post->post_date;
                $sday   = date("j", strtotime($sdate));
                $smonth = date("F", strtotime($sdate));
                ?>

                <article class="module-5-card">
                    <!-- 1. CỘT TRÁI: ẢNH ĐẠI DIỆN -->
                    <div class="module-5-col-thumb">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <!-- Ảnh thay thế nếu bài viết chưa gắn thumbnail -->
                                <img src="https://picsum.photos/400/250?random=<?php echo $post->ID; ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- 2. CỘT GIỮA: KHỐI NGÀY - THÁNG (DATE BADGE) -->
                    <div class="module-5-col-date">
                        <span class="date-day"><?php echo esc_html($post_date); ?></span>
                        <span class="date-month">THÁNG <?php echo esc_html($post_month); ?></span>
                    </div>

                    <!-- 3. CỘT PHẢI: TIÊU ĐỀ & TÓM TẮT -->
                    <div class="module-5-col-content">
                        <h3 class="post-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Phân trang nếu có nhiều bài viết -->
            <div class="module-5-pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '&laquo; Trước',
                    'next_text' => 'Sau &raquo;',
                ));
                ?>
            </div>

        <?php else : ?>
            <!-- Hiển thị khi không tìm thấy kết quả nào -->
            <div class="module-5-no-results">
                <p>Không tìm thấy bài viết nào phù hợp với từ khóa "<strong><?php echo esc_html(get_search_query()); ?></strong>".</p>
                <p style="margin-top: 8px; font-size: 13px;">Vui lòng kiểm tra lại chính tả hoặc thử với từ khóa khác.</p>
            </div>
        <?php endif; ?>
    </div>

</div>