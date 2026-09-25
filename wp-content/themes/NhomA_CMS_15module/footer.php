<?php
/**
 * The template for displaying the footer
 * Nạp Module 3: Footer (Bootsnipp rlXdE)
 */
?>

<!-- =======================================================================
     KHU VỰC HIỂN THỊ WIDGET PHÍA TRÊN FOOTER (MỤC #2: TRANG CHỦ, DANH SÁCH, CHI TIẾT - 10 ĐIỂM)
     ======================================================================= -->
<section class="above-footer-widget-area" id="widget_test_4_area">
    <?php
    if (is_active_sidebar('above-footer-sidebar')) {
        dynamic_sidebar('above-footer-sidebar');
    } else {
        // Tự động gọi widget_test_4 làm mặc định nếu chưa kéo trong WP-Admin
        the_widget('widget_test_4');
    }
    ?>
</section>

<?php
// Nạp trực tiếp từ thư mục Moudle3 đã tạo sẵn
include get_template_directory() . '/Moudle3/test.php';

wp_footer();
?>
</body>
</html>