<?php
/**
 * Index Template - NhomA_CMS_15module
 * Hiển thị giao diện chính tích hợp các Module
 */

get_header();
?>

<!-- NẠP MODULE 2: CONTENT (DANH SÁCH BÀI VIẾT TIN TỨC CHUẨN FIT-TDC) -->
<?php
$module2_path = get_template_directory() . '/Module2/test.php';
if (file_exists($module2_path)) {
    include $module2_path;
}
?>

<!-- NẠP TRỰC TIẾP MODULE 13 TỪ THƯ MỤC 13/TEST.PHP NẾU CÓ -->
<?php
$module13_path = get_template_directory() . '/13/test.php';
if (file_exists($module13_path)) {
    include $module13_path;
}
?>

<?php
get_footer();
