<?php
/**
 * Class ThanhNien_Footer_Widget
 * 
 * Widget WordPress tùy biến (Custom Widget) kế thừa từ WP_Widget.
 * Tuân thủ Liskov Substitution Principle (LSP) trong SOLID.
 * Cho phép người dùng kéo thả widget này vào bất kỳ vị trí Sidebar / Footer Widget Area nào.
 * 
 * @package Widget_Test_4
 * @author Senior Fullstack Engineer
 */

if (!defined('ABSPATH')) {
    exit;
}

class ThanhNien_Footer_Widget extends WP_Widget {

    /**
     * Khởi tạo Widget với ID, Tên và Mô tả
     */
    public function __construct() {
        parent::__construct(
            'thanhnien_footer_widget',
            __('Báo Thanh Niên - Footer Widget', 'widget-test-4'),
            array(
                'description'                 => __('Hiển thị khối chân trang chuẩn Báo Thanh Niên, tự động kết nối và đồng bộ từ Database.', 'widget-test-4'),
                'customize_selective_refresh' => true,
            )
        );
    }

    /**
     * Hiển thị Widget ngoài giao diện Frontend
     *
     * @param array $args     Các thẻ bao bọc (before_widget, after_widget, before_title, after_title)
     * @param array $instance Dữ liệu cấu hình đã lưu của Widget
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Nạp template render footer từ Database
        require get_template_directory() . '/inc/template-thanhnien-footer.php';

        echo $args['after_widget'];
    }

    /**
     * Form cấu hình Widget trong trang Quản trị Admin (Appearance > Widgets)
     *
     * @param array $instance Dữ liệu hiện tại
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $admin_url = admin_url('themes.php?page=thanhnien-footer-settings');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Tiêu đề Widget (Tùy chọn):', 'widget-test-4'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 12px; margin-top: 10px; font-size: 13px; color: #166534;">
            <p style="margin: 0 0 8px 0;"><strong>✨ Dữ liệu được kết nối trực tiếp Database:</strong></p>
            <p style="margin: 0 0 8px 0;">Các thông tin Hotline, Ban biên tập, Giấy phép, Mạng xã hội đang được truy xuất tự động từ bảng <code>wp_thanhnien_footer_settings</code>.</p>
            <p style="margin: 0;">
                👉 <a href="<?php echo esc_url($admin_url); ?>" target="_blank" style="color: #0284c7; text-decoration: underline; font-weight: bold;">
                    Bấm vào đây để chỉnh sửa dữ liệu Database trong Quản trị &raquo;
                </a>
            </p>
        </div>
        <?php
    }

    /**
     * Xử lý lưu và làm sạch dữ liệu cấu hình Widget
     *
     * @param array $new_instance Dữ liệu mới gửi lên
     * @param array $old_instance Dữ liệu cũ đã lưu
     * @return array
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}
