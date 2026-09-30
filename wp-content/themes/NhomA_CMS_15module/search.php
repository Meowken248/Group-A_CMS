<?php

/**
 * Template Name: Search Page
 * Bố cục Trang Tìm kiếm chuẩn 100% theo Hình ảnh cấu trúc 2:
 * - Header (1)
 * - Search bar (4)
 * - 3 Cột:
 *   + Cột 1 (Trái): Module 13
 *   + Cột 2 (Giữa): Search result (Module 5)
 *   + Cột 3 (Phải): Module 14
 * - Hàng dưới: Module 15
 * - Footer (3)
 */

get_header();
?>

<!-- MODULE 4: SEARCH BAR / KHUNG TÌM KIẾM -->
<div class="search-banner-wrap mb-4">
    <?php
    $module4_path = get_template_directory() . '/Moudle4/test.php';
    if (file_exists($module4_path)) {
        include $module4_path;
    }
    ?>
</div>

<!-- 3 CỘT: MODULE 13 (TRÁI) - SEARCH RESULT 5 (GIỮA) - MODULE 14 (PHẢI) -->
<div class="row">
    <!-- CỘT 1 (TRÁI): MODULE 13 -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module13_path = get_template_directory() . '/13/test.php';
        if (file_exists($module13_path)) {
            include $module13_path;
        }
        ?>
    </div>

    <!-- CỘT 2 (GIỮA): SEARCH RESULT (MODULE 5) -->
    <div class="col-lg-6 col-md-4 mb-4 search-result-col">
        <style>
            .search-result-col .fit-search-container {
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
        </style>
        <?php
        if (have_posts()) {
            if (file_exists(get_template_directory() . '/Module 5/search.php')) {
                include get_template_directory() . '/Module 5/search.php';
            } elseif (file_exists(get_template_directory() . '/Module 5/test.php')) {
                include get_template_directory() . '/Module 5/test.php';
            }
        } else {
            echo '<div class="alert alert-info text-center p-4 rounded shadow-sm bg-white">Không tìm thấy bài viết nào phù hợp với từ khóa "' . esc_html(get_search_query()) . '". Hãy thử tìm kiếm bằng từ khóa khác.</div>';
        }
        ?>
    </div>

    <!-- CỘT 3 (PHẢI): MODULE 14 -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module14_path = get_template_directory() . '/14/test.php';
        if (file_exists($module14_path)) {
            include $module14_path;
        }
        ?>
    </div>
</div>

<!-- HÀNG PHÍA DƯỚI: MODULE 15 -->
<div class="row mt-4 mb-4">
    <div class="col-12">
        <?php
        $module15_path = get_template_directory() . '/15/test.php';
        if (file_exists($module15_path)) {
            include $module15_path;
        }
        ?>
    </div>
</div>

<?php
get_footer();
