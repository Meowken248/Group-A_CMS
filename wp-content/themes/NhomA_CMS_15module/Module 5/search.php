<?php

/**
 * =========================================================================
 * MODULE 5: SEARCH RESULT (KẾT QUẢ TÌM KIẾM)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 5/search.php
 * Thiết kế giao diện: Thẻ tin tức ngang chuẩn xác 100% theo mẫu fit.tdc.edu.vn
 * =========================================================================
 */
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

<style>
    /* ===================================================
       CSS MODULE 5: THẺ TIN TỨC CHUẨN MẪU FIT TDC
       =================================================== */
    .fit-search-container {
        max-width: 920px;
        margin: 30px auto 50px;
        padding: 0 15px;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Thẻ tin tức (Card) - Khung viền mỏng phẳng, không padding để ảnh ôm sát mép ngoài */
    .fit-search-item {
        display: flex;
        align-items: stretch;
        background: #ffffff;
        border: 1px solid #e0e0e0;
        margin-bottom: 24px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .fit-search-item:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* CỘT 1: ẢNH ĐẠI DIỆN (THUMBNAIL) - 340px ôm sát mép trên/trái */
    .fit-search-thumb {
        flex: 0 0 340px;
        width: 340px;
        align-self: flex-start;
        margin: 0;
        overflow: hidden;
        background-color: #f8fafc;
        line-height: 0;
    }

    .fit-search-thumb a {
        display: block;
        width: 100%;
        line-height: 0;
    }

    .fit-search-thumb img,
    .fit-search-thumb svg {
        width: 100%;
        height: 190px;
        object-fit: cover;
        display: block;
        border: none;
    }

    /* CỘT 2: KHỐI NGÀY - THÁNG (DATE BADGE) */
    .fit-search-date {
        flex: 0 0 150px;
        width: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        padding-top: 36px;
        text-align: center;
        background: #ffffff;
        user-select: none;
    }

    .fit-search-date .date-number {
        font-size: 50px;
        font-weight: 400;
        color: #1a1a1a;
        line-height: 1;
        margin-bottom: 8px;
        font-family: "Times New Roman", Times, Georgia, serif;
    }

    .fit-search-date .date-text {
        font-size: 11.5px;
        font-weight: 600;
        color: #8c8c8c;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        white-space: nowrap;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* CỘT 3: TIÊU ĐỀ & TÓM TẮT (CÓ ĐƯỜNG PHÂN CÁCH DỌC TRÁI) */
    .fit-search-content {
        flex: 1;
        min-width: 0;
        position: relative;
        padding: 30px 28px 28px 26px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    /* Đường kẻ phân cách dọc giữa khối ngày và nội dung */
    .fit-search-content::before {
        content: "";
        position: absolute;
        left: 0;
        top: 20px;
        bottom: 20px;
        width: 1px;
        background-color: #cbd5e1;
    }

    .fit-search-title {
        margin: 0 0 16px 0;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.38;
        text-transform: uppercase;
        font-family: Arial, Helvetica, sans-serif;
    }

    .fit-search-title a {
        color: #0174c6;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .fit-search-title a:hover {
        color: #0056b3;
        text-decoration: none;
    }

    .fit-search-excerpt {
        font-size: 13.5px;
        color: #707070;
        line-height: 1.6;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    .fit-search-excerpt p {
        margin: 0;
        display: inline;
    }

    /* PHÂN TRANG */
    .fit-search-pagination {
        margin-top: 30px;
        text-align: center;
    }

    .fit-search-pagination .page-numbers {
        display: inline-block;
        padding: 6px 12px;
        margin: 0 2px;
        background: #ffffff;
        border: 1px solid #dddddd;
        color: #0174c6;
        text-decoration: none;
        font-size: 13px;
        border-radius: 3px;
    }

    .fit-search-pagination .page-numbers.current {
        background: #0174c6;
        color: #ffffff;
        border-color: #0174c6;
    }

    @media (max-width: 768px) {
        .fit-search-item {
            flex-direction: column;
        }

        .fit-search-thumb {
            width: 100%;
            height: auto;
            flex: none;
        }

        .fit-search-thumb img {
            height: 200px;
        }

        .fit-search-content::before {
            display: none;
        }

        .fit-search-date {
            flex-direction: row;
            width: 100%;
            justify-content: flex-start;
            padding: 12px 18px;
            gap: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .fit-search-date .date-number {
            font-size: 32px;
            margin-bottom: 0;
        }

        .fit-search-content {
            padding: 18px;
        }
    }
</style>

<div class="fit-search-container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            // Bỏ qua page (chỉ hiển thị tin tức / post để khớp mẫu)
            if (get_post_type() !== 'post') {
                continue;
            }

            // ==========================================================
            // ÁP DỤNG ĐÚNG CÁC ĐOẠN CODE GỢI Ý CỦA GIẢNG VIÊN TRONG ĐỀ BÀI
            // ==========================================================
            $post = get_post();
            $date = $post->post_date;
            $day = date("j", strtotime($date));
            $month = date("F", strtotime($date));

            $post_date = get_the_date('d', $post->ID);
            $post_month = get_the_date('m', $post->ID);
            ?>

            <article class="fit-search-item">
                <!-- 1. CỘT ẢNH ĐẠI DIỆN: Lấy từ CSDL qua the_post_thumbnail() -->
                <div class="fit-search-thumb">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            <img src="https://via.placeholder.com/340x190?text=FIT-TDC" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                    </a>
                </div>

                <!-- 2. CỘT NGÀY - THÁNG (DATE BADGE) -->
                <div class="fit-search-date">
                    <div class="date-number"><?php echo esc_html($post_date); ?></div>
                    <div class="date-text">THÁNG <?php echo esc_html($post_month); ?></div>
                </div>

                <!-- 3. CỘT TIÊU ĐỀ & TÓM TẮT -->
                <div class="fit-search-content">
                    <h3 class="fit-search-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="fit-search-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>

        <div class="fit-search-pagination">
            <?php
            the_posts_pagination(array(
                'prev_text' => '&laquo; Trước',
                'next_text' => 'Sau &raquo;',
            ));
            ?>
        </div>
    <?php endif; ?>
</div>