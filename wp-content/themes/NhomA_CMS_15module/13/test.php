<?php
/**
 * ==========================================================
 * MODULE 13: PAGES (DANH SÁCH TRANG ĐÀO TẠO)
 * Đường dẫn: C:\Users\Admin\source\Group-A_CMS\wp-content\themes\NhomA_CMS_15module\13\test.php
 * Thiết kế chuẩn giao diện tin tức / chuyên mục FIT - Cao đẳng Công nghệ Thủ Đức (TDC)
 * 
 * YÊU CẦU ĐỀ BÀI:
 * - Thay thế hiển thị mặc định của widget Pages (trước chỉnh sửa chỉ hiển thị link văn bản "Sample Page")
 * - Sau chỉnh sửa: Hiển thị các Trang (Pages) gồm: Tiêu đề, Hình đại diện, Tóm tắt nội dung
 * - Ghi chú GV:
 *   + Theo hình chụp ban đầu: 3 bài viết / trang trên 1 dòng
 *   + Theo vị trí hiển thị (sidebar / responsive): SV hãy cho nó rớt dòng (dạng responsive)
 *   + Như vậy mỗi dòng: 1 bài viết (Hình đứng dạng cột)
 * ==========================================================
 */

// Truy vấn danh sách các Page từ WordPress
$module13_args = array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
);

$module13_pages_query = new WP_Query($module13_args);

// Dữ liệu dự phòng (Fallback) nếu cơ sở dữ liệu chưa có trang
$module13_fallbacks = [
    [
        'title'   => 'Ngành Công Nghệ Thông Tin',
        'excerpt' => 'Trang bị cho sinh viên kiến thức và kỹ năng để trở thành nhà phát triển phần mềm chuyên nghiệp.',
        'image'   => get_template_directory_uri() . '/13/images/cntt.jpg',
        'link'    => '#',
    ],
    [
        'title'   => 'Ngành Truyền Thông & Mạng Máy Tính',
        'excerpt' => 'Sinh viên có khả năng nghiên cứu, thiết kế, phát triển và triển khai các ứng dụng về các công nghệ Mạng máy tính.',
        'image'   => get_template_directory_uri() . '/13/images/mang-may-tinh.jpg',
        'link'    => '#',
    ],
    [
        'title'   => 'Ngành Thiết Kế Đồ Hoạ',
        'excerpt' => 'Cung cấp các kiến thức về thiết kế đồ hoạ và công nghệ thông tin đa phương tiện.',
        'image'   => get_template_directory_uri() . '/13/images/thiet-ke-do-hoa.jpg',
        'link'    => '#',
    ]
];
?>

<!-- Định kiểu CSS riêng cho Module 13 -->
<style>
    .module-13-wrapper {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        margin: 20px auto;
        max-width: 1140px;
    }

    /* Khung chứa giao diện widget/module */
    .module-13-card-box {
        background: #ffffff;
        border: 1px solid #dbe2ea;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        margin-bottom: 30px;
    }

    /* Thanh tiêu đề Module: "Trang mới nhất" */
    .module-13-header {
        background: #f8fafc;
        border-bottom: 2px solid #005baa;
        padding: 12px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .module-13-header-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #005baa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .module-13-header-title i {
        font-size: 15px;
    }

    /* Thanh chuyển đổi chế độ xem (Cột đứng GV yêu cầu / Lưới 3 cột) */
    .module-13-view-toggle {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .module-13-btn-toggle {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #475569;
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .module-13-btn-toggle:hover {
        background: #f1f5f9;
        color: #005baa;
        border-color: #005baa;
    }

    .module-13-btn-toggle.active {
        background: #005baa;
        color: #ffffff;
        border-color: #005baa;
    }

    /* Vùng chứa các bài viết / trang */
    .module-13-body {
        padding: 22px;
    }

    /* -------------------------------------------------------------
       BỐ CỤC 1: HÌNH ĐỨNG DẠNG CỘT (MỖI DÒNG 1 BÀI VIẾT - ĐỀ BÀI YÊU CẦU)
       ------------------------------------------------------------- */
    .module-13-list.layout-column {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .module-13-list.layout-column .module-13-item {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border-bottom: 1px solid #edf2f7;
        padding-bottom: 24px;
    }

    .module-13-list.layout-column .module-13-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    /* -------------------------------------------------------------
       BỐ CỤC 2: DẠNG LƯỚI 3 CỘT (3 BÀI VIẾT TRÊN 1 DÒNG KHI CÓ KHÔNG GIAN)
       ------------------------------------------------------------- */
    .module-13-list.layout-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .module-13-list.layout-grid .module-13-item {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
        padding: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .module-13-list.layout-grid .module-13-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
    }

    /* Chi tiết từng thành phần bài viết */
    .module-13-item-title {
        margin: 0 0 12px 0;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.4;
    }

    .module-13-item-title a {
        color: #1e293b;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .module-13-item-title a:hover {
        color: #005baa;
    }

    /* Khung hình ảnh */
    .module-13-item-thumb {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 5px;
        background: #f1f5f9;
        margin-bottom: 12px;
        aspect-ratio: 16 / 9;
    }

    .module-13-item-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .module-13-item-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .module-13-item:hover .module-13-item-thumb img {
        transform: scale(1.04);
    }

    /* Tóm tắt nội dung */
    .module-13-item-excerpt {
        font-size: 13.5px;
        color: #475569;
        line-height: 1.6;
    }

    .module-13-item-excerpt p {
        margin: 0;
    }

    /* Responsive cho màn hình nhỏ */
    @media (max-width: 992px) {
        .module-13-list.layout-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .module-13-list.layout-grid {
            grid-template-columns: 1fr;
        }

        .module-13-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .module-13-view-toggle {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

<div class="module-13-wrapper">
    <div class="module-13-card-box">
        <!-- HEADER CỦA MODULE -->
        <div class="module-13-header">
            <h3 class="module-13-header-title">
                <i class="fa-solid fa-layer-group"></i> Trang mới nhất
            </h3>

            <!-- Nút chuyển đổi nhanh chế độ xem linh hoạt -->
            <div class="module-13-view-toggle">
                <button type="button" 
                        class="module-13-btn-toggle active" 
                        id="btnColumnView" 
                        onclick="setModule13Layout('column')">
                    <i class="fa-solid fa-grip-lines"></i> Hình đứng dạng cột (Đề bài GV)
                </button>
                <button type="button" 
                        class="module-13-btn-toggle" 
                        id="btnGridView" 
                        onclick="setModule13Layout('grid')">
                    <i class="fa-solid fa-table-cells"></i> Lưới 3 cột ngang
                </button>
            </div>
        </div>

        <!-- DANH SÁCH BÀI VIẾT / TRANG -->
        <div class="module-13-body">
            <div class="module-13-list layout-column" id="module13List">
                <?php if ($module13_pages_query->have_posts()) : ?>
                    <?php 
                    $index = 0;
                    while ($module13_pages_query->have_posts()) : $module13_pages_query->the_post(); 
                        $thumb_url = '';
                        if (has_post_thumbnail()) {
                            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        } else {
                            // Fallback hình ảnh nếu trang chưa đặt ảnh đại diện
                            $thumb_url = isset($module13_fallbacks[$index]['image']) 
                                ? $module13_fallbacks[$index]['image'] 
                                : get_template_directory_uri() . '/13/images/cntt.jpg';
                        }
                        
                        $excerpt = get_the_excerpt();
                        if (empty($excerpt)) {
                            $excerpt = wp_trim_words(get_the_content(), 25, '...');
                        }
                        if (empty($excerpt) && isset($module13_fallbacks[$index]['excerpt'])) {
                            $excerpt = $module13_fallbacks[$index]['excerpt'];
                        }
                    ?>
                        <article class="module-13-item">
                            <!-- 1. TIÊU ĐỀ BÀI VIẾT / TRANG -->
                            <h4 class="module-13-item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>

                            <!-- 2. HÌNH ĐẠI DIỆN -->
                            <div class="module-13-item-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                </a>
                            </div>

                            <!-- 3. TÓM TẮT NỘI DUNG -->
                            <div class="module-13-item-excerpt">
                                <p><?php echo esc_html($excerpt); ?></p>
                            </div>
                        </article>
                    <?php 
                        $index++;
                    endwhile; 
                    wp_reset_postdata();
                    ?>
                <?php else : ?>
                    <!-- NẠP DỮ LIỆU DỰ PHÒNG NẾU CHƯA CÓ TRANG TRONG DATABASE -->
                    <?php foreach ($module13_fallbacks as $fb) : ?>
                        <article class="module-13-item">
                            <h4 class="module-13-item-title">
                                <a href="<?php echo esc_url($fb['link']); ?>">
                                    <?php echo esc_html($fb['title']); ?>
                                </a>
                            </h4>

                            <div class="module-13-item-thumb">
                                <a href="<?php echo esc_url($fb['link']); ?>">
                                    <img src="<?php echo esc_url($fb['image']); ?>" alt="<?php echo esc_attr($fb['title']); ?>">
                                </a>
                            </div>

                            <div class="module-13-item-excerpt">
                                <p><?php echo esc_html($fb['excerpt']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT CHUYỂN ĐỔI CHẾ ĐỘ XEM TRỰC TIẾP -->
<script>
function setModule13Layout(mode) {
    var list = document.getElementById('module13List');
    var btnColumn = document.getElementById('btnColumnView');
    var btnGrid = document.getElementById('btnGridView');

    if (!list || !btnColumn || !btnGrid) return;

    if (mode === 'grid') {
        list.classList.remove('layout-column');
        list.classList.add('layout-grid');
        btnGrid.classList.add('active');
        btnColumn.classList.remove('active');
    } else {
        list.classList.remove('layout-grid');
        list.classList.add('layout-column');
        btnColumn.classList.add('active');
        btnGrid.classList.remove('active');
    }
}
</script>
