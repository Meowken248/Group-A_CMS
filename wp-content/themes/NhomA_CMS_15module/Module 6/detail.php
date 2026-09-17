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
       =================================================== */
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
    }

    /* HEADER: TIÊU ĐỀ BÀI VIẾT */
    .fit-detail-header {
        margin-bottom: 20px;
    }

    .fit-detail-title {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.35;
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
    }

    .fit-detail-content p {
        margin-bottom: 16px;
        text-align: justify;
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
    }

    .fit-detail-thumb img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
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
            padding: 20px;
        }

        .fit-detail-title {
            font-size: 22px;
        }
    }
</style>

<div class="fit-detail-wrapper">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="fit-detail-card">
                <!-- 1. TIÊU ĐỀ BÀI VIẾT -->
                <header class="fit-detail-header">
                    <h1 class="fit-detail-title"><?php the_title(); ?></h1>
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
            </article>
    <?php endwhile;
    endif; ?>
</div>