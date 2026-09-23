<?php
/**
 * Template Name: Search Page / Trang danh sách (tìm kiếm)
 * Bố cục chuẩn theo sơ đồ đánh giá của Giảng viên (FIT TDC):
 * 
 * +--------------------------------------------------------+
 * |                      Header (1)                        |
 * +--------------------------------------------------------+
 * |                      Search (4)                        |
 * +--------------------+---------------------+-------------+
 * |                    |                     |             |
 * |        13          |  Search result (5)  |     14      |
 * | (Pages rớt dòng)   |                     | (Comments)  |
 * |                    |                     |             |
 * +--------------------+---------------------+-------------+
 * |                          15                            |
 * |                (Last posts timeline)                   |
 * +--------------------------------------------------------+
 * |                        Footer                          |
 * +--------------------------------------------------------+
 */

get_header();
?>

<!-- 1. MODULE 4: SEARCH (BOOTSNIPP 35V6b) -->
<div class="row">
    <div class="col-12">
        <?php
        $module4_path = get_template_directory() . '/4/test.php';
        if (file_exists($module4_path)) {
            include $module4_path;
        }
        ?>
    </div>
</div>

<!-- 2. KHU VỰC 3 CỘT: [ 13 (Cột trái) ] [ 5 (Search result giữa) ] [ 14 (Cột phải) ] -->
<div class="row">
    <!-- CỘT TRÁI: MODULE 13 (PAGES - DẠNG RỚT DÒNG, MỖI DÒNG 1 BÀI VIẾT) -->
    <div class="col-lg-3 col-md-12 mb-4">
        <aside class="sidebar-module-13">
            <?php
            $module13_path = get_template_directory() . '/13/test.php';
            if (file_exists($module13_path)) {
                include $module13_path;
            }
            ?>
        </aside>
    </div>

    <!-- CỘT GIỮA: MODULE 5 (SEARCH RESULT - DANH SÁCH BÀI VIẾT KẾT QUẢ TÌM KIẾM) -->
    <div class="col-lg-6 col-md-12 mb-4">
        <main class="main-module-5">
            <?php
            $module5_path = get_template_directory() . '/Module 5/test.php';
            if (file_exists($module5_path)) {
                include $module5_path;
            }
            ?>
        </main>
    </div>

    <!-- CỘT PHẢI: MODULE 14 (COMMENTS - BÌNH LUẬN BOOTSNIPP gNVj0) -->
    <div class="col-lg-3 col-md-12 mb-4">
        <aside class="sidebar-module-14">
            <?php
            $module14_path = get_template_directory() . '/14/test.php';
            if (file_exists($module14_path)) {
                include $module14_path;
            }
            ?>
        </aside>
    </div>
</div>

<!-- 3. PHÍA DƯỚI TOÀN BỘ CHIỀU RỘNG: MODULE 15 (LAST POSTS - TIMELINE BOOTSNIPP xrKXW) -->
<div class="row mt-2">
    <div class="col-12 mb-4">
        <section class="section-module-15">
            <?php
            $module15_path = get_template_directory() . '/15/test.php';
            if (file_exists($module15_path)) {
                include $module15_path;
            }
            ?>
        </section>
    </div>
</div>

<!-- 4. KHỐI TIỆN ÍCH DƯỚI CÙNG: MODULE 16 (LIÊN KẾT NHANH & BẢN TIN) -->
<div class="row">
    <div class="col-12 mb-4">
        <section class="section-module-16">
            <?php
            $module16_path = get_template_directory() . '/16/test.php';
            if (file_exists($module16_path)) {
                include $module16_path;
            }
            ?>
        </section>
    </div>
</div>

<?php
get_footer();

