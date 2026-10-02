    </div><!-- .site-container -->
</main><!-- .site-main -->

<?php
/**
 * The template for displaying the footer
 * Nạp Module 3: Footer (Bootsnipp rlXdE)
 *
 * Ghi chú kỹ thuật:
 * Theo yêu cầu đề bài, Widget Footer #1 (Module 11 - Archive) và Footer #2 (Module 12 - Comments)
 * đã được chuyển ra bố cục 3 cột ở trang chủ (index.php) kẹp 2 bên Content (2).
 */
?>

<!-- =======================================================================
     KHU VỰC: CÁC WIDGET TEST 4 PHÍA TRÊN FOOTER
     Hiển thị tại: Trang chủ, Trang danh sách, Trang chi tiết
     ======================================================================= -->

<!-- 1. WIDGET TEST 4: BẤT ĐỘNG SẢN (NGUYỄN THÀNH ĐẠT) -->
<?php if (class_exists('Widget_Test_4_BDS')) : ?>
<section class="above-footer-widget-area" id="widget_test_4_bds_area">
    <?php
    if (is_active_sidebar('above-footer-sidebar')) {
        dynamic_sidebar('above-footer-sidebar');
    } else {
        the_widget('Widget_Test_4_BDS');
    }
    ?>
</section>
<?php endif; ?>

<!-- 2. WIDGET TEST 4: BÁO MỚI (HUỲNH ANH TÚ) -->
<?php if (class_exists('Widget_Test_4')) : ?>
<section class="widget-test-4-section" id="widget_test_4_area">
    <div class="site-container">
        <div class="widget-test-4-container-box">
            <?php
            if (is_active_sidebar('widget_test_4')) {
                dynamic_sidebar('widget_test_4');
            } elseif (class_exists('Widget_Test_4')) {
                the_widget('Widget_Test_4');
            }
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 3. WIDGET TEST 4: CHUYÊN MỤC THIẾT BỊ (BÙI NGUYỄN MINH QUÂN) -->
<div class="wt4-above-footer-area" id="widget_test_4_thietbi_area">
    <?php
    if (function_exists('is_active_sidebar') && is_active_sidebar('above-footer')) {
        dynamic_sidebar('above-footer');
    } else {
        $wt4_path = get_template_directory() . '/widget_test_4/widget_test_4.php';
        if (file_exists($wt4_path)) {
            include_once $wt4_path;
            if (function_exists('nhom_a_render_widget_test_4')) {
                nhom_a_render_widget_test_4();
            }
        }
    }
    ?>
</div>

<?php
$module3_path = get_template_directory() . '/Moudle3/test.php';
if (file_exists($module3_path)) {
    include $module3_path;
} else {
?>
    <footer class="site-footer">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> - <strong>Nhóm A CMS (15 Modules)</strong> - Khoa Công Nghệ Thông Tin (FIT TDC).</p>
        </div>
    </footer>
<?php } ?>

<!-- Tải thư viện JS cho Bootstrap Dropdown và tương tác giao diện -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>