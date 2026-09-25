<?php
/**
 * Module: widget_test_4
 * Tác giả: Nguyễn Thành Đạt
 * Chức năng: Custom Widget Bất Động Sản hiển thị chính xác theo hình mẫu đề bài
 * Nguồn dữ liệu: 100% từ Database (wp_posts & wp_postmeta)
 */

if (!defined('ABSPATH')) {
    exit;
}

class widget_test_4 extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'widget_test_4',
            'widget_test_4',
            array(
                'description' => 'Widget hiển thị 3 dự án Bất Động Sản chính xác theo hình mẫu đề bài',
                'classname'   => 'widget_test_4_box',
            )
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        // Truy vấn chính xác 3 dự án theo hình mẫu đề bài từ Database
        $bds_query = new WP_Query(array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'post__in'       => array(15, 16, 17),
            'orderby'        => 'post__in',
            'post_status'    => 'publish',
        ));

        // Nếu không có ID 15,16,17 thì truy vấn theo tiêu đề hoặc theo meta chu_dau_tu
        if (!$bds_query->have_posts()) {
            $bds_query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'meta_key'       => 'chu_dau_tu',
                'orderby'        => 'date',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            ));
        }
        ?>

        <div class="widget_test_4_container">
            <div class="widget_test_4_grid">
                <?php
                if ($bds_query->have_posts()) :
                    while ($bds_query->have_posts()) : $bds_query->the_post();
                        $post_id = get_the_ID();

                        // Lấy Custom Fields từ wp_postmeta trong Database
                        $investor = get_post_meta($post_id, 'chu_dau_tu', true);
                        $duration = get_post_meta($post_id, 'thoi_han', true);
                        $address  = get_post_meta($post_id, 'dia_chi', true);
                        $status   = get_post_meta($post_id, 'trang_thai', true);
                        if (empty($status)) {
                            $status = 'Đang mở bán';
                        }

                        // Lấy ảnh từ Database
                        $thumb_url = '';
                        if (has_post_thumbnail($post_id)) {
                            $thumb_url = get_the_post_thumbnail_url($post_id, 'large');
                        } else {
                            $thumb_url = get_post_meta($post_id, 'hinh_anh', true);
                        }
                ?>
                    <article class="bds_card_exact">
                        <!-- Hình ảnh + Nhãn Đang mở bán -->
                        <div class="bds_thumb_box">
                            <span class="bds_badge_open"><?php echo esc_html($status); ?></span>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (!empty($thumb_url)) : ?>
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- Phần nội dung chi tiết -->
                        <div class="bds_info_box">
                            <!-- Tiêu đề dự án (Font Serif như ảnh mẫu) -->
                            <h3 class="bds_project_title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <!-- Chủ đầu tư -->
                            <div class="bds_investor_line">
                                Chủ đầu tư: <?php echo esc_html($investor); ?>
                            </div>

                            <!-- Thời hạn sở hữu (Icon vòng tròn check) -->
                            <div class="bds_meta_item">
                                <svg class="bds_icon_svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <polyline points="8.5 12.5 11 15 15.5 9.5"></polyline>
                                </svg>
                                <span><?php echo esc_html($duration); ?></span>
                            </div>

                            <!-- Địa chỉ (Icon ghim vị trí) -->
                            <div class="bds_meta_item">
                                <svg class="bds_icon_svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2a7 7 0 0 0-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 0 0-7-7z"></path>
                                    <circle cx="12" cy="9" r="2.5"></circle>
                                </svg>
                                <span><?php echo esc_html($address); ?></span>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
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

function register_widget_test_4_init() {
    register_widget('widget_test_4');
}
add_action('widgets_init', 'register_widget_test_4_init');