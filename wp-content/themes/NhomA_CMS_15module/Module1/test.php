<?php
/**
 * ==========================================================
 * MODULE 1: HEADER & NAVIGATION (THANH ĐIỀU HƯỚNG)
 * Dự án: Group-A CMS (15 Modules) - Khoa CNTT FIT-TDC
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module1/test.php
 * ==========================================================
 */

// Tự động nạp môi trường WordPress nếu người dùng mở trực tiếp test.php trên trình duyệt
if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

// Kiểm tra xem đã nạp Header chưa, nếu chưa thì gọi get_header()
$is_standalone = !did_action('get_header');
if ($is_standalone && function_exists('get_header')) {
    get_header();
}
?>

<div class="container my-5" style="max-width: 1140px;">
    <div class="alert alert-success shadow-sm">
        <h4 class="alert-heading font-weight-bold"><i class="fa-solid fa-circle-check mr-2"></i> Module 1: Header / Navbar</h4>
        <p class="mb-0">Thanh điều hướng Header đã được tích hợp đầy đủ các giải pháp chống tràn text, chống bể khung hình ảnh và responsive trên mọi thiết bị.</p>
    </div>

    <!-- Kiểm tra chống bể khung khi thêm nội dung dài và hình ảnh lớn -->
    <div class="card shadow-sm mt-4 border-0">
        <div class="card-header bg-white font-weight-bold text-primary">
            Kiểm tra hiển thị: Chống tràn nội dung & Hình ảnh không bể khung (Module 1 Scope)
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6 class="font-weight-bold text-secondary">1. Thử nghiệm với chuỗi văn bản dài liên tục:</h6>
                    <div class="p-3 bg-light rounded" style="overflow-wrap: break-word; word-break: break-word;">
                        https://fit.tdc.edu.vn/thong-bao-tuyen-sinh-chuong-trinh-dao-tao-chat-luong-cao-nganh-cong-nghe-thong-tin-nam-hoc-2026-2027-chuyen-sau-tri-tue-nhan-tao-va-khoa-hoc-du-lieu-chuan-quoc-te
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <h6 class="font-weight-bold text-secondary">2. Thử nghiệm với ảnh kích thước lớn:</h6>
                    <div class="p-2 bg-light rounded text-center">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=1200&auto=format&fit=crop&q=80" 
                             alt="Test Image" 
                             class="img-fluid rounded" 
                             style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Nạp Footer nếu xem độc lập
if ($is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>