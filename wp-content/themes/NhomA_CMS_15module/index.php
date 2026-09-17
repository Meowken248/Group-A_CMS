<?php
/**
 * Index Template - NhomA_CMS_15module
 * Hiển thị giao diện chính tích hợp Module 13: Pages
 */

get_header();
?>

<!-- NẠP TRỰC TIẾP MODULE 13 TỪ THƯ MỤC 13/TEST.PHP -->
<?php
$module13_path = get_template_directory() . '/13/test.php';
if (file_exists($module13_path)) {
    include $module13_path;
} else {
    echo '<div class="alert alert-warning text-center">Không tìm thấy file Module 13 tại thư mục /13/test.php</div>';
}
?>

<?php
get_footer();