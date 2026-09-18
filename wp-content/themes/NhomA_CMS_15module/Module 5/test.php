<?php

/**
 * ==========================================================
 * MODULE 5: SEARCH RESULT
 * Đường dẫn: C:\Group-A_CMS\wp-content\themes\NhomA_CMS_15module\Module 5\test.php
 * Thiết kế chuẩn giao diện tin tức FIT - Cao đẳng Công nghệ Thủ Đức (TDC)
 * ==========================================================
 */
?>

<!-- Định kiểu CSS riêng cho Module 5 -->
<style>
    .module-5-search-container {
        width: 100%;
        margin-bottom: 25px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .module-5-search-header {
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #005baa;
    }

    .module-5-search-header h2 {
        font-size: 16px;
        color: #005baa;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0;
    }

    .module-5-search-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    /* Thẻ tin tức ngang */
    .module-5-post-card {
        display: flex;
        align-items: flex-start;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        overflow: hidden;
        padding: 12px;
        gap: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease-in-out;
    }

    .module-5-post-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    /* 1. Cột Ảnh đại diện */
    .module-5-thumb {
        flex: 0 0 130px;
        width: 130px;
        height: 95px;
        overflow: hidden;
        border-radius: 4px;
        background: #f1f5f9;
    }

    .module-5-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .module-5-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .module-5-thumb:hover img {
        transform: scale(1.05);
    }

    /* 2. Cột Khối Ngày - Tháng */
    .module-5-date-badge {
        flex: 0 0 55px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 8px 0 0;
        border-right: 1px solid #edf2f7;
    }

    .module-5-date-badge .day-number {
        font-size: 26px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
        font-family: inherit;
    }

    .module-5-date-badge .month-text {
        font-size: 9.5px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-top: 3px;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    /* 3. Cột Tiêu đề & Nội dung tóm tắt */
    .module-5-content {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .module-5-title {
        margin: 0 0 6px 0;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.35;
        text-transform: uppercase;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .module-5-title a {
        color: #005baa;
        text-decoration: none;
        transition: color 0.2s;
    }

    .module-5-title a:hover {
        color: #d32f2f;
    }

    .module-5-excerpt {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.6;
    }

    .module-5-excerpt p {
        margin: 0;
    }

    /* Thông báo không có kết quả */
    .module-5-empty {
        background: #ffffff;
        padding: 40px 20px;
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

    @media (max-width: 768px) {
        .module-5-post-card {
            flex-direction: column;
        }

        .module-5-thumb {
            width: 100%;
            max-width: 100%;
            height: 180px;
        }

        .module-5-date-badge {
            flex-direction: row;
            gap: 12px;
            border-right: none;
            border-bottom: 1px solid #edf2f7;
            width: 100%;
            padding-right: 0;
            padding-bottom: 8px;
        }

        .module-5-date-badge .day-number {
            font-size: 26px;
        }
    }
</style>

<div class="module-5-search-container">
    <div class="module-5-search-header">
        <h2>
            <?php 
            if (is_search() && get_search_query()) {
                echo 'Kết quả tìm kiếm cho: "' . esc_html(get_search_query()) . '"';
            } elseif (is_search()) {
                echo 'Kết quả tìm kiếm';
            } else {
                echo 'Tin tức & Hoạt động đào tạo FIT TDC';
            }
            ?>
        </h2>
    </div>

    <div class="module-5-search-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                // ==========================================================
                // ÁP DỤNG ĐOẠN CODE GỢI Ý CỦA GIẢNG VIÊN (FIT TDC)
                // ==========================================================
                $post = get_post();

                // Lấy ngày (2 chữ số, ví dụ 07, 08)
                $post_date = get_the_date('d', $post->ID);

                // Lấy tháng (2 chữ số, ví dụ 10)
                $post_month = get_the_date('m', $post->ID);

                // Hoặc tính theo timestamp ngày đăng bài:
                $sdate  = $post->post_date;
                $sday   = date("j", strtotime($sdate));
                $smonth = date("F", strtotime($sdate));
                ?>

                <article class="module-5-post-card">
                    <!-- CỘT 1: ẢNH ĐẠI DIỆN BÀI VIẾT -->
                    <div class="module-5-thumb">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('news-thumb'); ?>
                            <?php else : ?>
                                <!-- Ảnh mẫu nếu bài viết chưa có thumbnail -->
                                <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=500&auto=format&fit=crop&q=60" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- CỘT 2: KHỐI NGÀY - THÁNG (DATE BADGE) -->
                    <div class="module-5-date-badge">
                        <span class="day-number"><?php echo esc_html($post_date); ?></span>
                        <span class="month-text">THÁNG <?php echo esc_html($post_month); ?></span>
                    </div>

                    <!-- CỘT 3: TIÊU ĐỀ & TÓM TẮT BÀI VIẾT -->
                    <div class="module-5-content">
                        <h3 class="module-5-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        <div class="module-5-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Phân trang nếu nhiều kết quả -->
            <div class="module-5-pagination">
                <?php the_posts_pagination(array(
                    'prev_text' => '&laquo; Trước',
                    'next_text' => 'Sau &raquo;',
                )); ?>
            </div>

        <?php else : ?>
            <div class="module-5-empty">
                <p>Không tìm thấy bài viết nào phù hợp với từ khóa "<strong><?php echo esc_html(get_search_query()); ?></strong>".</p>
                <p style="margin-top: 8px; font-size: 13px;">Vui lòng thử tìm kiếm lại với từ khóa khác.</p>
            </div>
        <?php endif; ?>
    </div>
</div>