<?php
/**
 * ==========================================================
 * MODULE 4: SEARCH (GIAO DIỆN TÌM KIẾM BOOTSNIPP 35V6b)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/4/test.php
 * Thiết kế chuẩn Bootsnipp 35V6b theo đúng tài liệu đánh giá (PDF Trang 4)
 * ==========================================================
 */

$module4_is_standalone = !did_action('get_header');
if ($module4_is_standalone && function_exists('get_header')) {
    get_header();
}

$search_query = function_exists('get_search_query') ? get_search_query() : (isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '');
$display_keyword = !empty($search_query) ? $search_query : 'Công nghệ thông tin';
?>

<!-- Định kiểu CSS cho Module 4 (Bootsnipp 35V6b) -->
<style>
    .module-4-search-section {
        width: 100%;
        margin: 15px auto 25px auto;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    .module-4-card {
        background: #ffffff;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    /* 1. Phần trên nền trắng: Tiêu đề & Thông báo */
    .module-4-top-content {
        padding: 24px 20px 18px 20px;
        text-align: center;
        background-color: #ffffff;
    }

    .module-4-title {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 8px 0;
        letter-spacing: -0.2px;
    }

    .module-4-title .text-red {
        color: #d90429;
    }

    .module-4-title .text-query {
        color: #111827;
    }

    .module-4-subtitle {
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
        max-width: 600px;
        margin: 0 auto;
    }

    /* 2. Phần dưới nền màu be (Warm Beige Banner) của Bootsnipp 35V6b */
    .module-4-search-banner {
        background-color: #f6f1e5;
        padding: 25px 20px;
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
        padding: 6px 8px 6px 16px;
        border: 1px solid #ffffff;
        transition: box-shadow 0.2s ease;
    }

    .module-4-search-form:focus-within {
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    }

    .module-4-search-icon {
        color: #475569;
        font-size: 17px;
        margin-right: 12px;
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .module-4-search-input {
        flex: 1;
        border: none;
        outline: none;
        background: transparent;
        font-size: 15px;
        color: #222222;
        padding: 6px 0;
        min-width: 0;
    }

    .module-4-search-input::placeholder {
        color: #94a3b8;
    }

    /* Nút Search màu xanh lá (Green Button) chuẩn Hình 2 đề bài */
    .module-4-search-btn {
        background-color: #28a745;
        color: #ffffff;
        font-size: 14.5px;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        padding: 8px 22px;
        cursor: pointer;
        flex-shrink: 0;
        transition: background-color 0.2s ease;
    }

    .module-4-search-btn:hover {
        background-color: #218838;
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
                <?php if (is_search() && !have_posts()) : ?>
                    We could not find any results for your search. You can give it another try through the search form below.
                <?php else : ?>
                    Tìm kiếm bài viết, chuyên ngành đào tạo và thông tin tuyển sinh FIT - TDC.
                <?php endif; ?>
            </p>
        </div>

        <!-- PHẦN DƯỚI NỀN BE: KHUNG TÌM KIẾM BOOTSNIPP 35V6b -->
        <div class="module-4-search-banner">
            <form role="search" method="get" class="module-4-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <span class="module-4-search-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="search" 
                       class="module-4-search-input" 
                       placeholder="Search topics or keywords" 
                       value="<?php echo esc_attr(get_search_query()); ?>" 
                       name="s" 
                       title="Search topics or keywords" 
                       required>
                <button type="submit" class="module-4-search-btn">Search</button>
            </form>
        </div>
    </div>
</div>

<?php
if ($module4_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
