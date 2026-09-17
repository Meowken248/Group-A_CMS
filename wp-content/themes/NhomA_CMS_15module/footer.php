    </div><!-- .site-container -->
</main><!-- .site-main -->

<?php
/**
 * The template for displaying the footer
 * Nạp Module 3: Footer (Bootsnipp rlXdE)
 */
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