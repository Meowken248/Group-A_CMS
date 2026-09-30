<?php

/**
 * Single Post Template - NhomA_CMS_15module
 * Bố cục Trang Chi Tiết chuẩn 100% theo thiết kế Hình 3:
 * - Hàng 1 (3 Cột):
 *   + Cột 1 (Trái): Categories (Module 9)
 *   + Cột 2 (Giữa): Detail (Module 6) - Nội dung chi tiết bài viết từ CSDL
 *   + Cột 3 (Phải): Recent post (Module 10) - Danh sách bài viết mới nhất
 * - Hàng 2 (Trải rộng phía dưới): Prev - Next Post (Module 7)
 * - Hàng 3 (Trải rộng phía dưới): Comments (Module 8)
 * - Chân trang: Footer (Module 3)
 */

get_header();
?>

<!-- HÀNG 1: 3 CỘT (CATEGORIES 9 - DETAIL 6 - RECENT POST 10) -->
<div class="row">
    <!-- CỘT 1 (TRÁI): CATEGORIES (MODULE 9) -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module9_path = get_template_directory() . '/module9/module9.php';
        if (file_exists($module9_path)) {
            include $module9_path;
        }
        ?>
    </div>

    <!-- CỘT 2 (GIỮA): DETAIL (MODULE 6) - BÀI VIẾT THẬT TỪ CƠ SỞ DỮ LIỆU -->
    <div class="col-lg-6 col-md-4 mb-4 single-detail-col">
        <style>
            .single-detail-col .fit-detail-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .single-detail-col .fit-detail-card {
                padding: 24px 22px 28px !important;
                border-radius: 4px;
            }
        </style>
        <?php
        if (have_posts()) {
            $skip_inner_modules = true; // Module 7 và 8 sẽ được nạp ở hàng riêng phía dưới theo đúng Hình 3
            if (file_exists(get_template_directory() . '/Module 6/detail.php')) {
                include get_template_directory() . '/Module 6/detail.php';
            } elseif (file_exists(get_template_directory() . '/Module 6/test.php')) {
                include get_template_directory() . '/Module 6/test.php';
            }
        }
        ?>
    </div>

    <!-- CỘT 3 (PHẢI): RECENT POST (MODULE 10) -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module10_path = get_template_directory() . '/module10/module10.php';
        if (file_exists($module10_path)) {
            include $module10_path;
        }
        ?>
    </div>
</div>

<!-- HÀNG 2: PREV - NEXT POST (MODULE 7) - RỘNG TOÀN KHUNG PHÍA DƯỚI HÀNG 1 -->
<div class="row mt-2">
    <div class="col-12">
        <div class="bg-white p-3 border rounded shadow-sm">
            <?php
            if (file_exists(get_template_directory() . '/Module 7/prev-next.php')) {
                include get_template_directory() . '/Module 7/prev-next.php';
            } elseif (file_exists(get_template_directory() . '/Module 7/test.php')) {
                include get_template_directory() . '/Module 7/test.php';
            }
            ?>
        </div>
    </div>
</div>

<!-- HÀNG 3: COMMENTS (MODULE 8) - RỘNG TOÀN KHUNG PHÍA DƯỚI HÀNG 2 -->
<div class="row mt-4 mb-4">
    <div class="col-12">
        <div class="bg-white p-4 border rounded shadow-sm">
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
        </div>
    </div>
</div>

<?php
get_footer();
