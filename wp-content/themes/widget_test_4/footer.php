<!-- ======================================================== -->
<!-- KHU VỰC: WIDGET_TEST_4 (PHÍA TRÊN FOOTER)                 -->
<!-- Hiển thị tại: Trang chủ (4đ), Trang danh sách (3đ), Trang chi tiết (3đ) -->
<!-- ======================================================== -->
<section class="widget-test-4-section">
    <div class="site-container">
        <div class="widget-test-4-container-box">
            <?php
            if (is_active_sidebar('widget_test_4')) {
                dynamic_sidebar('widget_test_4');
            } else {
                the_widget('Widget_Test_4');
            }
            ?>
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="site-container">
        <p>&copy; <?php echo date('Y'); ?> - <?php bloginfo('name'); ?>. CMS Lab 4 - SV: Huỳnh Anh Tú.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>