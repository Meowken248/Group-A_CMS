<?php

/**
 * =========================================================================
 * MODULE 7: PREV - NEXT POST (ĐIỀU HƯỚNG BÀI VIẾT)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 7/prev-next.php
 * Thiết kế giao diện: Chuẩn mẫu 100% theo fit.tdc.edu.vn (Ngày phân số + Tiêu đề)
 * =========================================================================
 */

global $post;

$next_post = get_next_post();     // Bài viết mới hơn
$prev_post = get_previous_post(); // Bài viết cũ hơn

// Nếu không có cả 2 bài thì không hiển thị
if (!$next_post && !$prev_post) {
    return;
}
?>

<style>
    /* ===================================================
       CSS MODULE 7: DANH SÁCH BÀI VIẾT KẾ TIẾP & TRƯỚC ĐÓ
       CHUẨN XÁC 100% THEO ẢNH MẪU FIT TDC
       ĐÃ GIA CỐ PHÒNG THỦ CHỐNG VỠ KHUNG (DEFENSIVE CSS)
       =================================================== */
    .fit-prev-next-wrapper,
    .fit-prev-next-wrapper * {
        box-sizing: border-box;
    }

    .fit-prev-next-wrapper {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #e5e7eb;
        font-family: Arial, Helvetica, sans-serif;
        max-width: 100%;
    }

    .fit-prev-next-list {
        display: flex;
        flex-direction: column;
        gap: 22px;
        max-width: 100%;
    }

    .fit-prev-next-item {
        display: flex;
        align-items: center;
        gap: 30px;
        max-width: 100%;
    }

    /* Khối phân số ngày tháng (Didone Serif thanh lịch) - Cố định 45px không co rúm */
    .fit-pn-date {
        display: inline-flex;
        align-items: center;
        font-family: Georgia, "Times New Roman", Times, serif;
        color: #333333;
        user-select: none;
        flex-shrink: 0;
        width: 45px;
        justify-content: flex-start;
    }

    .fit-pn-fraction {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .fit-pn-day {
        font-size: 13.5px;
        font-weight: 400;
        line-height: 1;
        color: #222222;
    }

    .fit-pn-sep {
        width: 17px;
        height: 1px;
        background-color: #222222;
        margin: 2px 0;
    }

    .fit-pn-month {
        font-size: 13.5px;
        font-weight: 400;
        line-height: 1;
        color: #222222;
    }

    .fit-pn-year {
        font-size: 13.5px;
        font-weight: 400;
        margin-left: 3px;
        line-height: 1;
        color: #222222;
        align-self: center;
    }

    /* Tiêu đề bài viết: tự động ngắt chữ chống toạc dòng */
    .fit-pn-title {
        flex: 1;
        min-width: 0;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-pn-title a {
        font-size: 15.5px;
        font-weight: 400;
        color: #333333;
        text-decoration: none;
        line-height: 1.5;
        transition: color 0.15s ease;
        display: inline-block;
        max-width: 100%;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    .fit-pn-title a:hover {
        color: #005baa;
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .fit-prev-next-item {
            gap: 16px;
        }

        .fit-pn-title a {
            font-size: 14px;
        }
    }
</style>

<div class="fit-prev-next-wrapper">
    <div class="fit-prev-next-list">
        <!-- 1. BÀI VIẾT KẾ TIẾP (NEXT POST) -->
        <?php if (!empty($next_post)) : ?>
            <div class="fit-prev-next-item">
                <div class="fit-pn-date" title="<?php echo esc_attr(get_the_date('d/m/Y', $next_post->ID)); ?>">
                    <div class="fit-pn-fraction">
                        <span class="fit-pn-day"><?php echo esc_html(get_the_date('d', $next_post->ID)); ?></span>
                        <span class="fit-pn-sep"></span>
                        <span class="fit-pn-month"><?php echo esc_html(get_the_date('m', $next_post->ID)); ?></span>
                    </div>
                    <span class="fit-pn-year"><?php echo esc_html(get_the_date('y', $next_post->ID)); ?></span>
                </div>
                <div class="fit-pn-title">
                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                        <?php echo esc_html(get_the_title($next_post->ID)); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <!-- 2. BÀI VIẾT TRƯỚC ĐÓ (PREVIOUS POST) -->
        <?php if (!empty($prev_post)) : ?>
            <div class="fit-prev-next-item">
                <div class="fit-pn-date" title="<?php echo esc_attr(get_the_date('d/m/Y', $prev_post->ID)); ?>">
                    <div class="fit-pn-fraction">
                        <span class="fit-pn-day"><?php echo esc_html(get_the_date('d', $prev_post->ID)); ?></span>
                        <span class="fit-pn-sep"></span>
                        <span class="fit-pn-month"><?php echo esc_html(get_the_date('m', $prev_post->ID)); ?></span>
                    </div>
                    <span class="fit-pn-year"><?php echo esc_html(get_the_date('y', $prev_post->ID)); ?></span>
                </div>
                <div class="fit-pn-title">
                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                        <?php echo esc_html(get_the_title($prev_post->ID)); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>