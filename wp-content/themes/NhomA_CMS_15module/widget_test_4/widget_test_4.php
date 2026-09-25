<?php
/**
 * Widget Test 4 - widget_test_4
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Widget Test 4
 *
 * Mô tả: Widget hiển thị tin tức theo chuyên mục dạng sidebar
 *         - Tiêu đề chuyên mục có thanh đỏ dọc bên trái
 *         - Bài viết đầu tiên: thumbnail + tiêu đề
 *         - Bài viết 2, 3: chỉ tiêu đề, ngăn cách bởi đường kẻ ngang
 *
 * Vị trí hiển thị: Phía trên Footer (trang chủ, trang danh sách, trang chi tiết)
 */

// Nạp stylesheet riêng cho Widget Test 4
$wt4_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $wt4_css_url = get_template_directory_uri() . '/widget_test_4/style.css';
} else {
    $wt4_css_url = (basename(dirname($_SERVER['SCRIPT_NAME'] ?? '')) === 'widget_test_4') ? 'style.css' : 'widget_test_4/style.css';
}

// ======================================================
// CLASS WIDGET (chỉ đăng ký khi chạy trong WordPress)
// ======================================================
if (class_exists('WP_Widget')) {

    class Widget_Test_4 extends WP_Widget
    {
        /**
         * Constructor: Đăng ký widget
         */
        public function __construct()
        {
            parent::__construct(
                'widget_test_4',
                'Widget Test 4 - Tin Chuyên Mục',
                array(
                    'description' => 'Widget hiển thị 3 bài viết mới nhất theo chuyên mục (1 ảnh + 2 text). Thiết kế bởi Quân - Nhóm A.',
                )
            );
        }

        /**
         * Front-end: Hiển thị widget trên giao diện
         */
        public function widget($args, $instance)
        {
            echo $args['before_widget'];
            // Gọi hàm render chung
            nhom_a_render_widget_test_4();
            echo $args['after_widget'];
        }

        /**
         * Back-end: Form cài đặt trong Admin
         */
        public function form($instance)
        {
            echo '<p>Widget Test 4 tự động hiển thị 3 bài viết mới nhất theo chuyên mục ngẫu nhiên.</p>';
        }
    }
}

// ======================================================
// HÀM RENDER CHÍNH: Hiển thị giao diện Widget Test 4
// ======================================================
function nhom_a_render_widget_test_4()
{
    // Kiểm tra trạng thái ẩn/hiện (cho phép tạm ẩn theo yêu cầu)
    if (function_exists('get_option') && get_option('wt4_widget_visible', '1') === '0') {
        return;
    }

    // Lấy CSS URL
    $wt4_css_url = '';
    if (function_exists('get_template_directory_uri')) {
        $wt4_css_url = get_template_directory_uri() . '/widget_test_4/style.css';
    } else {
        $wt4_css_url = 'widget_test_4/style.css';
    }

    // ===== QUERY BÀI VIẾT TỪ WORDPRESS =====
    $posts_data = array();
    $widget_title = 'Thiết bị'; // Tiêu đề mặc định

    if (function_exists('get_posts') && function_exists('get_categories')) {
        // Lấy danh sách chuyên mục (trừ Uncategorized)
        $categories = get_categories(array(
            'orderby'    => 'count',
            'order'      => 'DESC',
            'hide_empty' => true,
            'exclude'    => array(1), // Loại bỏ Uncategorized (ID=1)
        ));

        // Cố định chuyên mục theo ngày (tất cả 3 trang hiển thị giống nhau trong cùng 1 ngày)
        $selected_cat_id = 0;
        if (!empty($categories)) {
            $day_seed = intval(date('Ymd')); // Seed theo ngày: 20260925
            $cat_index = $day_seed % count($categories);
            $cat_keys = array_keys($categories);
            $selected_cat = $categories[$cat_keys[$cat_index]];
            $selected_cat_id = $selected_cat->term_id;
            $widget_title = $selected_cat->name;
        }

        // Query 3 bài viết mới nhất từ chuyên mục đã chọn
        $query_args = array(
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );
        if ($selected_cat_id > 0) {
            $query_args['cat'] = $selected_cat_id;
        }

        $wp_posts = get_posts($query_args);

        if (!empty($wp_posts)) {
            foreach ($wp_posts as $index => $post) {
                $thumb_url = '';
                if ($index === 0 && has_post_thumbnail($post->ID)) {
                    // Thử lấy ảnh theo các size, ưu tiên medium > news-thumb > full
                    $thumb_url = get_the_post_thumbnail_url($post->ID, 'medium');
                    if (empty($thumb_url)) {
                        $thumb_url = get_the_post_thumbnail_url($post->ID, 'full');
                    }
                }
                $posts_data[] = array(
                    'title' => get_the_title($post->ID),
                    'url'   => get_permalink($post->ID),
                    'thumb' => $thumb_url,
                );
            }
        }
    }

    // ===== DỮ LIỆU MẪU (Fallback khi chưa có bài viết) =====
    if (empty($posts_data)) {
        $widget_title = 'Thiết bị';
        $posts_data = array(
            array(
                'title' => 'Pin giấy có thể nuốt vào bụng, cấp điện cho thiết bị y tế 3 ngày rồi tự tan',
                'url'   => '#',
                'thumb' => 'https://placehold.co/280x180/e2e8f0/475569?text=Pin+giay',
            ),
            array(
                'title' => 'Kính thông minh bị kêu gọi cấm ở châu Âu vì lo quay lén',
                'url'   => '#',
                'thumb' => '',
            ),
            array(
                'title' => 'Những thông tin rò rỉ về iPhone 18 màn hình gập',
                'url'   => '#',
                'thumb' => '',
            ),
        );
    }

    // ===== RENDER HTML =====
    ?>
    <!-- Widget Test 4: CSS -->
    <link rel="stylesheet" href="<?php echo esc_url($wt4_css_url); ?>">

    <div class="wt4-widget-container">
        <div class="wt4-card">
            <!-- Tiêu đề chuyên mục với thanh đỏ bên trái -->
            <h3 class="wt4-title">
                <span class="wt4-title-bar"></span>
                <?php echo esc_html($widget_title); ?>
            </h3>

            <!-- Danh sách bài viết -->
            <div class="wt4-posts-list">
                <?php foreach ($posts_data as $index => $post_item) : ?>
                    <div class="wt4-post-item <?php echo ($index === 0) ? 'wt4-post-featured' : 'wt4-post-text'; ?>">
                        <?php if ($index === 0 && !empty($post_item['thumb'])) : ?>
                            <!-- Bài viết đầu tiên: có ảnh thumbnail -->
                            <a href="<?php echo esc_url($post_item['url']); ?>" class="wt4-thumb-link">
                                <img src="<?php echo esc_url($post_item['thumb']); ?>"
                                     alt="<?php echo esc_attr($post_item['title']); ?>"
                                     class="wt4-thumbnail"
                                     loading="lazy">
                            </a>
                        <?php endif; ?>

                        <h4 class="wt4-post-title">
                            <a href="<?php echo esc_url($post_item['url']); ?>">
                                <?php echo esc_html($post_item['title']); ?>
                            </a>
                        </h4>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}
?>
