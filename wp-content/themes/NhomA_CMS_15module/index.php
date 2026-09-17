<?php get_header(); ?>

<!-- NẠP MODULE 2: CONTENT (DANH SÁCH BÀI VIẾT TIN TỨC CHUẨN FIT-TDC) -->
<?php
// Nạp trực tiếp Module 2: Content
include get_template_directory() . '/Module2/test.php';
?>

<!-- Tải thư viện JS cho Bootstrap Dropdown hoạt động -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<?php wp_footer(); ?>
</body>
</html>