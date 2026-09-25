<?php
/**
 * Module: widget_test_4
 * Tác giả: Nguyễn Thành Đạt
 * Chức năng: Định nghĩa Custom Widget Bất Động Sản Random
 * Nguồn dữ liệu: 100% LẤY TRỰC TIẾP TỪ DATABASE (wp_posts & wp_postmeta)
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 1. Định nghĩa Class Custom Widget: widget_test_4
 */
class widget_test_4 extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_test_4', // ID Widget theo yêu cầu của thầy
            'widget_test_4', // Tên Widget hiển thị trong WP-Admin
            array(
                'description' => 'Widget hiển thị dự án Bất Động Sản ngẫu nhiên lấy 100% từ Database',
                'classname'   => 'widget_test_4_box',
            )
        );
    }

    /**
     * Xuất giao diện Widget ra Frontend - 100% LẤY TỪ DATABASE
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        // Truy vấn 3 bài viết NGẪU NHIÊN trực tiếp từ bảng wp_posts trong DATABASE
        $bds_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'rand',
            'post_status'    => 'publish',
        ));
        ?>

        <div class="widget_test_4_wrapper">
            <div class="widget_test_4_grid">
                <?php
                if ($bds_query->have_posts()) :
                    while ($bds_query->have_posts()) : $bds_query->the_post();
                        $post_id = get_the_ID();

                        // 1. Lấy dữ liệu Custom Fields từ bảng wp_postmeta trong DATABASE
                        $investor = get_post_meta($post_id, 'chu_dau_tu', true);
                        $duration = get_post_meta($post_id, 'thoi_han', true);
                        $address  = get_post_meta($post_id, 'dia_chi', true);
                        $status   = get_post_meta($post_id, 'trang_thai', true);

                        // Mặc định trạng thái nếu chưa đặt
                        if (empty($status)) {
                            $status = 'Đang mở bán';
                        }

                        // 2. Lấy hình ảnh từ DATABASE (Featured Image hoặc meta hinh_anh)
                        $thumb_url = '';
                        if (has_post_thumbnail($post_id)) {
                            $thumb_url = get_the_post_thumbnail_url($post_id, 'medium_large');
                        } else {
                            $thumb_url = get_post_meta($post_id, 'hinh_anh', true);
                        }
                ?>
                    <article class="bds_card_item">
                        <!-- Khung hình ảnh + Badge "Đang mở bán" góc trên bên trái -->
                        <div class="bds_card_thumb">
                            <span class="bds_badge_status"><?php echo esc_html($status); ?></span>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (!empty($thumb_url)) : ?>
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                                <?php else : ?>
                                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#e2e8f0; color:#64748b;">
                                        Hình ảnh dự án
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- Khung thông tin chi tiết lấy 100% từ Database -->
                        <div class="bds_card_body">
                            <!-- Tiêu đề lấy từ Database: the_title() -->
                            <h4 class="bds_card_title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>

                            <!-- Chủ đầu tư lấy từ wp_postmeta: chu_dau_tu -->
                            <?php if (!empty($investor)) : ?>
                                <div class="bds_card_investor">
                                    Chủ đầu tư: <span><?php echo esc_html($investor); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Thời hạn sở hữu lấy từ wp_postmeta: thoi_han -->
                            <?php if (!empty($duration)) : ?>
                                <div class="bds_card_meta_row">
                                    <svg class="bds_meta_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    <span><?php echo esc_html($duration); ?></span>
                                </div>
                            <?php endif; ?>

                            <!-- Địa chỉ lấy từ wp_postmeta: dia_chi -->
                            <?php if (!empty($address)) : ?>
                                <div class="bds_card_meta_row">
                                    <svg class="bds_meta_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span><?php echo esc_html($address); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p style="text-align: center; color: #64748b; padding: 20px;">
                        Chưa có dữ liệu bài viết trong cơ sở dữ liệu.
                    </p>
                <?php
                endif;
                ?>
            </div>
        </div>

        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'widget_test_4';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

/**
 * 2. Đăng ký Widget vào WordPress
 */
function register_widget_test_4_init() {
    register_widget('widget_test_4');
}
add_action('widgets_init', 'register_widget_test_4_init');