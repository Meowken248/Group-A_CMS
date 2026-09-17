<?php

/**
 * ==========================================================
 * MODULE 4: SEARCH (GIAO DIỆN TÌM KIẾM / KHÔNG TÌM THẤY KẾT QUẢ)
 * Dự án: Group-A CMS (15 Modules) - Khoa CNTT FIT-TDC
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Moudle4/test.php
 * Thiết kế chuẩn Bootsnipp 35V6b theo đúng ảnh mẫu (từ Hình 1 sang Hình 2)
 * ==========================================================
 */

// Tự động nạp môi trường WordPress nếu người dùng mở trực tiếp test.php trên trình duyệt
if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

// Kiểm tra xem đã nạp Header chưa, nếu chưa thì tự động gọi get_header()
$is_standalone = !did_action('get_header');
if ($is_standalone && function_exists('get_header')) {
    get_header();
}

// Lấy từ khóa tìm kiếm (mặc định hiển thị "abc" chuẩn như Hình 2)
$search_query = function_exists('get_search_query') ? get_search_query() : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '');
$display_keyword = !empty($search_query) ? $search_query : 'abc';
?>

<?php if ($is_standalone) : ?>
<!-- Nạp FontAwesome & Bootstrap dự phòng nếu chạy độc lập -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php endif; ?>

<!-- Định kiểu CSS cho Module 4: Chuyển đổi từ Hình 1 sang Hình 2 (Bootsnipp 35V6b) -->
<style>
    .module-4-search-section {
        width: 100%;
        max-width: 1140px;
        margin: 50px auto 70px auto;
        padding: 0 15px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .module-4-card {
        background: #ffffff;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid #eef0f2;
    }

    /* 1. Phần trên nền trắng: Tiêu đề & Thông báo */
    .module-4-top-content {
        padding: 45px 25px 35px 25px;
        text-align: center;
        background-color: #ffffff;
    }

    .module-4-title {
        font-size: 26px;
        font-weight: 700;
        margin: 0 0 14px 0;
        letter-spacing: -0.2px;
    }

    /* Chữ "Search:" màu đỏ nổi bật chuẩn Hình 2 */
    .module-4-title .text-red {
        color: #d90429;
    }

    /* Từ khóa trong ngoặc kép màu đen đậm chuẩn Hình 2 */
    .module-4-title .text-query {
        color: #111827;
    }

    /* Dòng mô tả thông báo không tìm thấy kết quả chuẩn 2 dòng như Hình 2 */
    .module-4-subtitle {
        color: #555555;
        font-size: 15px;
        line-height: 1.6;
        max-width: 530px;
        margin: 0 auto;
    }

    /* 2. Phần dưới nền màu be (Warm Beige Banner) của Bootsnipp 35V6b */
    .module-4-search-banner {
        background-color: #f6f1e5;
        padding: 45px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* 3. Khung tìm kiếm màu trắng (White Search Bar) */
    .module-4-search-form {
        width: 100%;
        max-width: 650px;
        background-color: #ffffff;
        border-radius: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        display: flex;
        align-items: center;
        padding: 6px 8px 6px 18px;
        border: 1px solid #ffffff;
        transition: box-shadow 0.2s ease;
    }

    .module-4-search-form:focus-within {
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    }

    /* Icon kính lúp đậm nét bên trái */
    .module-4-search-icon {
        color: #000000;
        font-size: 19px;
        margin-right: 14px;
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    /* Ô input nhập từ khóa */
    .module-4-search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 15.5px;
        color: #222222;
        padding: 8px 0;
        min-width: 0;
    }

    .module-4-search-input::placeholder {
        color: #777777;
        opacity: 0.9;
        font-size: 15px;
    }

    /* Nút Search màu xanh lá (Green Button) chuẩn Hình 2 */
    .module-4-search-btn {
        background-color: #28a745;
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        border: none;
        border-radius: 4px;
        padding: 9px 24px;
        cursor: pointer;
        flex-shrink: 0;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .module-4-search-btn:hover {
        background-color: #218838;
    }

    .module-4-search-btn:active {
        transform: scale(0.98);
    }

    /* Responsive cho màn hình nhỏ */
    @media (max-width: 576px) {
        .module-4-top-content {
            padding: 30px 15px 25px 15px;
        }

        .module-4-title {
            font-size: 22px;
        }

        .module-4-subtitle {
            font-size: 14px;
        }

        .module-4-search-banner {
            padding: 30px 15px;
        }

        .module-4-search-form {
            padding: 5px 6px 5px 12px;
        }

        .module-4-search-icon {
            font-size: 16px;
            margin-right: 10px;
        }

        .module-4-search-input {
            font-size: 14px;
        }

        .module-4-search-btn {
            padding: 8px 18px;
            font-size: 14px;
        }
    }
</style>

<div class="module-4-search-section">
    <div class="module-4-card">
        <!-- PHẦN TRÊN NỀN TRẮNG: TIÊU ĐỀ & MÔ TẢ -->
        <div class="module-4-top-content">
            <h2 class="module-4-title">
                <span class="text-red">Search:</span> <span class="text-query">&ldquo;<?php echo esc_html($display_keyword); ?>&rdquo;</span>
            </h2>
            <p class="module-4-subtitle">
                We could not find any results for your search. You can give it another try through the search form below.
            </p>
        </div>

        <!-- PHẦN DƯỚI NỀN BE: KHUNG TÌM KIẾM BOOTSNIPP 35V6b -->
        <div class="module-4-search-banner">
            <form role="search" method="get" class="module-4-search-form" action="<?php echo esc_url(function_exists('home_url') ? home_url('/') : '/'); ?>">
                <!-- Icon Kính lúp -->
                <span class="module-4-search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>

                <!-- Ô nhập liệu hiển thị placeholder "Search topics or keywords" chuẩn Hình 2 -->
                <input type="search" 
                       class="module-4-search-input" 
                       placeholder="Search topics or keywords" 
                       value="" 
                       name="s" 
                       title="Search topics or keywords" 
                       required>

                <!-- Nút tìm kiếm màu xanh lá -->
                <button type="submit" class="module-4-search-btn">Search</button>
            </form>
        </div>
    </div>
</div>

<?php
// Nạp Footer nếu xem độc lập
if ($is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
