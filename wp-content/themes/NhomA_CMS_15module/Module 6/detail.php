<?php

/**
 * =========================================================================
 * MODULE 6: DETAIL (TRANG CHI TIẾT BÀI VIẾT)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 6/single.php
 * Thiết kế giao diện: Chuẩn mẫu fit.tdc.edu.vn (Khan hiếm nhân lực CNTT)
 * =========================================================================
 */
?>

<style>
    /* ===================================================
       CSS MODULE 6: CHI TIẾT BÀI VIẾT CHUẨN MẪU FIT TDC
       ĐÃ GIA CỐ PHÒNG THỦ CHỐNG VỠ KHUNG (DEFENSIVE CSS)
       =================================================== */
    .fit-detail-wrapper,
    .fit-detail-wrapper * {
        box-sizing: border-box;
    }

    .fit-detail-wrapper {
        max-width: 980px;
        margin: 30px auto 50px;
        padding: 0 15px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .fit-detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 30px 35px 40px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        /* Ngăn chặn phần tử con tràn lề ngang */
        max-width: 100%;
    }

    /* HEADER: TIÊU ĐỀ VÀ DATE BADGE */
    .fit-detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 20px;
    }

    .fit-detail-title {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.35;
        flex: 1;
        min-width: 0;
        /* Cho phép flex item co lại và xuống hàng */
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    /* BADGE NGÀY THÁNG DẠNG TRÒN VÀNG (24/06 18) - Cố định 62px không bị méo tròn */
    .fit-detail-date-badge {
        flex: 0 0 62px;
        flex-shrink: 0;
        /* Đảm bảo luôn tròn xoe 62px, không bị co bẹp thành hình elip */
        width: 62px;
        height: 62px;
        border-radius: 50%;
        background-color: #f5b82e;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #222222;
        font-family: Georgia, "Times New Roman", Times, serif;
        user-select: none;
        margin-top: 2px;
    }

    .fit-detail-date-badge .date-fraction {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .fit-detail-date-badge .date-day {
        font-size: 13px;
        font-weight: 700;
        line-height: 1;
    }

    .fit-detail-date-badge .date-sep {
        width: 15px;
        height: 1.5px;
        background-color: #222222;
        margin: 2px 0;
    }

    .fit-detail-date-badge .date-month {
        font-size: 13px;
        font-weight: 700;
        line-height: 1;
    }

    .fit-detail-date-badge .date-year {
        font-size: 14px;
        font-weight: 700;
        margin-left: 2px;
        line-height: 1;
        align-self: center;
    }

    /* ĐƯỜNG KẺ PHÂN CÁCH CÓ NOTCH */
    .fit-detail-divider {
        position: relative;
        border-bottom: 1px solid #e2e8f0;
        margin: 18px 0 24px;
    }

    .fit-detail-divider::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 30px;
        width: 9px;
        height: 9px;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
        background: #ffffff;
        transform: rotate(45deg);
    }

    /* NỘI DUNG BÀI VIẾT */
    .fit-detail-content {
        color: #334155;
        font-size: 14.5px;
        line-height: 1.7;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 100%;
    }

    .fit-detail-content p {
        margin-bottom: 16px;
        text-align: justify;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-detail-content p:first-of-type,
    .fit-detail-content .fit-lead {
        font-style: italic;
        color: #64748b;
        font-size: 14.5px;
        line-height: 1.65;
    }

    /* ẢNH ĐẠI DIỆN NẾU CÓ */
    .fit-detail-thumb {
        margin-bottom: 22px;
        text-align: center;
        overflow: hidden;
        max-width: 100%;
    }

    .fit-detail-thumb img {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        display: inline-block;
    }

    /* TOÀN BỘ HÌNH ẢNH VÀ MEDIA TRONG BÀI VIẾT KHÔNG BAO GIỜ TRÀN KHUNG */
    .fit-detail-content img,
    .fit-detail-content figure,
    .fit-detail-content picture,
    .fit-detail-content video,
    .fit-detail-content audio,
    .fit-detail-content iframe,
    .fit-detail-content embed,
    .fit-detail-content object,
    .fit-detail-content .wp-caption {
        max-width: 100% !important;
        height: auto !important;
    }

    /* KHẮC PHỤC LỖI WORDPRESS TỰ ĐỘNG THÊM INLINE STYLE WIDTH TRÊN .wp-caption */
    .fit-detail-content .wp-caption {
        width: auto !important;
        max-width: 100% !important;
        margin: 15px auto;
        text-align: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px;
        border-radius: 4px;
    }

    .fit-detail-content .wp-caption img {
        display: block;
        margin: 0 auto;
    }

    .fit-detail-content .wp-caption-text,
    .fit-detail-content figcaption {
        font-size: 13px;
        color: #64748b;
        font-style: italic;
        margin-top: 6px;
        margin-bottom: 0;
        text-align: center;
    }

    /* HỖ TRỢ CÁC CLASS CĂN LỀ ẢNH CHUẨN WORDPRESS */
    .fit-detail-content .aligncenter {
        display: block;
        margin: 15px auto;
        clear: both;
    }

    .fit-detail-content .alignleft {
        float: left;
        margin: 6px 20px 15px 0;
        max-width: 50% !important;
    }

    .fit-detail-content .alignright {
        float: right;
        margin: 6px 0 15px 20px;
        max-width: 50% !important;
    }

    .fit-detail-content .alignnone {
        margin: 10px 0;
    }

    /* CLEARFIX CHO CONTENT */
    .fit-detail-content::after {
        content: "";
        display: table;
        clear: both;
    }

    /* BẢNG BIỂU: TỰ ĐỘNG CUỘN NGANG KHI BẢNG RỘNG, KHÔNG TOẠC KHUNG */
    .fit-detail-content table {
        display: block;
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-collapse: collapse;
        margin: 18px 0;
        border: 1px solid #e2e8f0;
    }

    .fit-detail-content table th,
    .fit-detail-content table td {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        text-align: left;
        font-size: 14px;
    }

    .fit-detail-content table th {
        background-color: #f1f5f9;
        font-weight: 600;
        color: #1e293b;
    }

    /* KHỐI MÃ NGUỒN PRE VÀ CODE */
    .fit-detail-content pre {
        max-width: 100%;
        overflow-x: auto;
        white-space: pre-wrap;
        word-break: break-all;
        background: #f8fafc;
        padding: 14px 18px;
        border-radius: 4px;
        border: 1px solid #e2e8f0;
        font-family: Consolas, Monaco, "Courier New", Courier, monospace;
        font-size: 13.5px;
        line-height: 1.5;
        margin: 16px 0;
    }

    .fit-detail-content code {
        background: #f1f5f9;
        color: #0f172a;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 13px;
        font-family: Consolas, Monaco, "Courier New", Courier, monospace;
        word-break: break-word;
    }

    .fit-detail-content pre code {
        background: transparent;
        padding: 0;
        border-radius: 0;
        color: inherit;
    }

    /* TRÍCH DẪN BLOCKQUOTE */
    .fit-detail-content blockquote {
        border-left: 4px solid #0174c6;
        margin: 18px 0;
        padding: 10px 18px;
        background: #f8fafc;
        color: #475569;
        font-style: italic;
    }

    .fit-detail-content .fit-source {
        text-align: right;
        font-style: italic;
        color: #64748b;
        margin-top: 24px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .fit-detail-card {
            padding: 20px 16px;
        }

        .fit-detail-title {
            font-size: 20px;
        }

        .fit-detail-content .alignleft,
        .fit-detail-content .alignright {
            float: none;
            margin: 12px auto;
            max-width: 100% !important;
            display: block;
        }
    }
</style>

<div class="fit-detail-wrapper">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            $post_day   = get_the_date('d');
            $post_month = get_the_date('m');
            $post_year  = get_the_date('y');
            ?>
            <article class="fit-detail-card">
                <!-- 1. TIÊU ĐỀ VÀ DATE BADGE TRÒN VÀNG -->
                <header class="fit-detail-header">
                    <h1 class="fit-detail-title"><?php the_title(); ?></h1>

                    <div class="fit-detail-date-badge" title="<?php echo esc_attr(get_the_date('d/m/Y')); ?>">
                        <div class="date-fraction">
                            <span class="date-day"><?php echo esc_html($post_day); ?></span>
                            <span class="date-sep"></span>
                            <span class="date-month"><?php echo esc_html($post_month); ?></span>
                        </div>
                        <span class="date-year"><?php echo esc_html($post_year); ?></span>
                    </div>
                </header>

                <!-- 2. ĐƯỜNG PHÂN CÁCH -->
                <div class="fit-detail-divider"></div>

                <!-- 3. NỘI DUNG CHI TIẾT BÀI VIẾT TỪ DATABASE -->
                <div class="fit-detail-content">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="fit-detail-thumb">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <?php the_content(); ?>
                </div>

                <!-- 4. NẠP MODULE 7: BÀI VIẾT TRƯỚC - TIẾP THEO (PREV - NEXT POST) -->
                <?php
                if (file_exists(get_template_directory() . '/Module 7/prev-next.php')) {
                    include get_template_directory() . '/Module 7/prev-next.php';
                } elseif (file_exists(get_template_directory() . '/Module 7/test.php')) {
                    include get_template_directory() . '/Module 7/test.php';
                }
                ?>

                <!-- 5. NẠP MODULE 8: BÌNH LUẬN (COMMENTS - BOOTSNIPP rNEdR) -->
                <?php
                if (comments_open() || get_comments_number()) {
                    if (file_exists(get_template_directory() . '/Module 8/comments.php')) {
                        include get_template_directory() . '/Module 8/comments.php';
                    } elseif (file_exists(get_template_directory() . '/Module 8/test.php')) {
                        include get_template_directory() . '/Module 8/test.php';
                    } else {
                        comments_template();
                    }
                }
                ?>
            </article>
    <?php endwhile;
    endif; ?>
</div>