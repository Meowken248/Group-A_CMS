    </div><!-- .site-container -->
</main><!-- .site-main -->

<!-- ========================================================== -->
<!-- KHU VỰC HIỂN THỊ WIDGET_TEST_4 (PHÍA TRÊN FOOTER)          -->
<!-- Hiển thị đồng bộ tại: Trang chủ, Trang danh sách, Trang chi tiết -->
<!-- ========================================================== -->
<?php
$widget_test_4_file = get_template_directory() . '/wedget_test_4/test.php';
if (file_exists($widget_test_4_file)) {
    include $widget_test_4_file;
}
?>

<footer class="site-footer">
    <div class="container text-center">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> - <strong>Nhóm A CMS (15 Modules)</strong> - Khoa Công Nghệ Thông Tin (FIT TDC).</p>
    </div>
</footer>

<!-- Tải thư viện JS cho Bootstrap Dropdown và tương tác giao diện -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>
