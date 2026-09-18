<?php
/**
 * ==========================================================
 * MODULE 13: PAGES (DANH SÁCH TRANG ĐÀO TẠO)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/13/test.php
 * Thiết kế chuẩn giao diện tin tức / chuyên mục FIT - Cao đẳng Công nghệ Thủ Đức (TDC)
 * ==========================================================
 */

if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

$module13_is_standalone = !did_action('get_header');
if ($module13_is_standalone && function_exists('get_header')) {
    get_header();
}

// Truy vấn danh sách các Page chuyên ngành (loại trừ các trang test runner 17, 18, 19)
$module13_args = array(
    'post_type'      => 'page',
    'post_status'    => 'publish',
    'post__not_in'   => array(17, 18, 19),
    'posts_per_page' => 5,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
);

$module13_pages_query = new WP_Query($module13_args);

// Dữ liệu dự phòng (Fallback) chuẩn 3 ngành TDC theo đề bài PDF Trang 10
$module13_fallbacks = [
    [
        'title'   => 'Ngành Công Nghệ Thông Tin',
        'excerpt' => 'Trang bị cho sinh viên kiến thức và kỹ năng để trở thành nhà phát triển phần mềm chuyên nghiệp.',
        'image'   => get_template_directory_uri() . '/13/images/cntt.jpg',
        'link'    => home_url('/?page_id=7'),
    ],
    [
        'title'   => 'Ngành Truyền Thông & Mạng Máy Tính',
        'excerpt' => 'Sinh viên có khả năng nghiên cứu, thiết kế, phát triển và triển khai các ứng dụng về các công nghệ Mạng máy tính.',
        'image'   => get_template_directory_uri() . '/13/images/mang-may-tinh.jpg',
        'link'    => home_url('/?page_id=9'),
    ],
    [
        'title'   => 'Ngành Thiết Kế Đồ Hoạ',
        'excerpt' => 'Cung cấp các kiến thức về thiết kế đồ hoạ và công nghệ thông tin đa phương tiện.',
        'image'   => get_template_directory_uri() . '/13/images/thiet-ke-do-hoa.jpg',
        'link'    => home_url('/?page_id=11'),
    ]
];
?>

<style>
    .module-13-widget {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .module-13-widget-header {
        background: #f8fafc;
        border-bottom: 2px solid #005baa;
        padding: 10px 15px;
    }

    .module-13-widget-title {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #005baa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .module-13-widget-body {
        padding: 15px;
    }

    /* Mặc định: Mỗi dòng 1 bài viết (Hình đứng dạng cột theo đề bài) */
    .module-13-container-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .module-13-item {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border-bottom: 1px solid #edf2f7;
        padding-bottom: 16px;
    }

    .module-13-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    /* 1. Tiêu đề bài viết / trang */
    .module-13-title {
        margin: 0 0 8px 0;
        font-size: 14.5px;
        font-weight: 700;
        line-height: 1.35;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    .module-13-title a {
        color: #1e293b;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .module-13-title a:hover {
        color: #005baa;
    }

    /* 2. Hình đại diện (Chiều cao chuẩn 130px, không bị kéo giãn) */
    .module-13-thumb {
        width: 100%;
        height: 130px;
        overflow: hidden;
        border-radius: 4px;
        background: #f1f5f9;
        margin-bottom: 8px;
    }

    .module-13-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .module-13-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.3s ease;
    }

    .module-13-item:hover .module-13-thumb img {
        transform: scale(1.04);
    }

    /* 3. Tóm tắt nội dung */
    .module-13-excerpt {
        font-size: 12.5px;
        color: #64748b;
        line-height: 1.5;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    .module-13-excerpt p {
        margin: 0;
    }

    /* Khi ở không gian rộng (trang độc lập không có sidebar) */
    .site-container > .module-13-widget .module-13-container-list,
    .module-13-fullwidth .module-13-container-list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .site-container > .module-13-widget .module-13-thumb,
    .module-13-fullwidth .module-13-thumb {
        height: 160px;
    }

    .sidebar-module-13 .module-13-container-list {
        display: flex !important;
        flex-direction: column !important;
    }
</style>

<div class="module-13-widget <?php echo ($module13_is_standalone ? 'module-13-fullwidth container my-4' : ''); ?>">
    <div class="module-13-widget-header">
        <h3 class="module-13-widget-title">
            <i class="fa-solid fa-graduation-cap"></i> Pages
        </h3>
    </div>

    <div class="module-13-widget-body">
        <div class="module-13-container-list">
            <?php if ($module13_pages_query->have_posts()) : ?>
                <?php 
                $m13_idx = 0;
                while ($module13_pages_query->have_posts()) : $module13_pages_query->the_post(); 
                    $thumb_url = '';
                    if (has_post_thumbnail()) {
                        $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    } else {
                        $thumb_url = isset($module13_fallbacks[$m13_idx]['image']) 
                            ? $module13_fallbacks[$m13_idx]['image'] 
                            : get_template_directory_uri() . '/13/images/cntt.jpg';
                    }
                    
                    $excerpt = get_the_excerpt();
                    if (empty($excerpt)) {
                        $excerpt = wp_trim_words(get_the_content(), 18, '...');
                    }
                    if (empty($excerpt) && isset($module13_fallbacks[$m13_idx]['excerpt'])) {
                        $excerpt = $module13_fallbacks[$m13_idx]['excerpt'];
                    }
                ?>
                    <article class="module-13-item">
                        <h4 class="module-13-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h4>

                        <div class="module-13-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </a>
                        </div>

                        <div class="module-13-excerpt">
                            <p><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </article>
                <?php 
                    $m13_idx++;
                endwhile; 
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php foreach ($module13_fallbacks as $fb) : ?>
                    <article class="module-13-item">
                        <h4 class="module-13-title">
                            <a href="<?php echo esc_url($fb['link']); ?>">
                                <?php echo esc_html($fb['title']); ?>
                            </a>
                        </h4>

                        <div class="module-13-thumb">
                            <a href="<?php echo esc_url($fb['link']); ?>">
                                <img src="<?php echo esc_url($fb['image']); ?>" alt="<?php echo esc_attr($fb['title']); ?>" loading="lazy">
                            </a>
                        </div>

                        <div class="module-13-excerpt">
                            <p><?php echo esc_html($fb['excerpt']); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
if ($module13_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
