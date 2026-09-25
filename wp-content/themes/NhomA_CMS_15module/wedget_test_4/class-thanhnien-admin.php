<?php
/**
 * Class ThanhNien_Footer_Admin
 * 
 * Trang quản trị cấu hình Footer Báo Thanh Niên (wedget_test_4)
 * Thiết kế giao diện ĐƠN GIẢN, tinh gọn, chuẩn phong cách WordPress Native settings.
 * 
 * @package NhomA_CMS_15module
 * @subpackage wedget_test_4
 * @author Senior Fullstack Engineer
 */

if (!defined('ABSPATH')) {
    exit;
}

class ThanhNien_Footer_Admin {

    /**
     * Đối tượng thao tác Database
     *
     * @var ThanhNien_Footer_DB
     */
    private $db;

    public function __construct() {
        $this->db = new ThanhNien_Footer_DB();
        add_action('admin_menu', array($this, 'register_admin_menu'));
        add_action('admin_init', array($this, 'handle_form_submission'));
    }

    /**
     * Đăng ký menu Quản trị trong Appearance
     */
    public function register_admin_menu() {
        add_theme_page(
            __('Cấu hình Footer Báo Thanh Niên', 'nhom-a'),
            __('Footer Thanh Niên (DB)', 'nhom-a'),
            'manage_options',
            'thanhnien-footer-settings',
            array($this, 'render_admin_page')
        );
    }

    /**
     * Xử lý Form POST
     */
    public function handle_form_submission() {
        if (!isset($_POST['thanhnien_footer_nonce_field'])) {
            return;
        }

        if (!current_user_can('manage_options')) {
            wp_die(__('Bạn không có quyền thực hiện thao tác này.', 'nhom-a'));
        }

        check_admin_referer('thanhnien_footer_nonce_action', 'thanhnien_footer_nonce_field');

        // Xử lý khôi phục mặc định
        if (!empty($_POST['thanhnien_reset'])) {
            $this->db->reset_to_defaults();
            wp_safe_redirect(add_query_arg(array('page' => 'thanhnien-footer-settings', 'status' => 'reset'), admin_url('themes.php')));
            exit;
        }

        // Xử lý textarea Ban biên tập thành 5 dòng
        if (isset($_POST['editorial_board'])) {
            $raw_board = sanitize_textarea_field(wp_unslash($_POST['editorial_board']));
            $lines = array_values(array_filter(array_map('trim', explode("\n", $raw_board))));
            for ($i = 1; $i <= 5; $i++) {
                $idx = $i - 1;
                $_POST['editorial_title_' . $i] = isset($lines[$idx]) ? $lines[$idx] : '';
            }
        }

        $this->db->update_batch($_POST);
        wp_safe_redirect(add_query_arg(array('page' => 'thanhnien-footer-settings', 'status' => 'saved'), admin_url('themes.php')));
        exit;
    }

    /**
     * Render giao diện Quản trị ĐƠN GIẢN chuẩn WordPress Native
     */
    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $d = $this->db->get_all();
        $status = isset($_GET['status']) ? sanitize_key($_GET['status']) : '';

        // Gom 5 dòng ban biên tập thành 1 chuỗi hiển thị gọn vào textarea
        $editorial_lines = array();
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($d['editorial_title_' . $i])) {
                $editorial_lines[] = $d['editorial_title_' . $i];
            }
        }
        $editorial_text = implode("\n", $editorial_lines);
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">Cài Đặt Footer Báo Thanh Niên</h1>
            <p class="description" style="margin-top: 6px; font-size: 13.5px; color: #64748b;">
                Tùy chỉnh thông tin chân trang hiển thị phía trên Footer. Dữ liệu được kết nối và lưu trực tiếp trong Database <code>wp_thanhnien_footer_settings</code>.
            </p>
            <hr class="wp-header-end">

            <?php if ($status === 'saved'): ?>
                <div class="notice notice-success is-dismissible">
                    <p><strong>✅ Đã lưu cài đặt vào Database thành công!</strong></p>
                </div>
            <?php elseif ($status === 'reset'): ?>
                <div class="notice notice-info is-dismissible">
                    <p><strong>🔄 Đã khôi phục dữ liệu gốc chuẩn Báo Thanh Niên!</strong></p>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <?php wp_nonce_field('thanhnien_footer_nonce_action', 'thanhnien_footer_nonce_field'); ?>

                <table class="form-table" role="presentation">
                    <tbody>
                        <!-- 1. Đường dây nóng Hotline -->
                        <tr>
                            <th scope="row">
                                <label for="hotline_number">Hotline</label>
                            </th>
                            <td>
                                <input name="hotline_number" type="text" id="hotline_number" value="<?php echo esc_attr($d['hotline_number']); ?>" class="regular-text">
                                <p class="description">Số điện thoại đường dây nóng (Mặc định: <code>0906 645 777</code>).</p>
                            </td>
                        </tr>

                        <!-- 2. Liên hệ quảng cáo -->
                        <tr>
                            <th scope="row">
                                <label for="ad_contact_number">Liên hệ quảng cáo</label>
                            </th>
                            <td>
                                <input name="ad_contact_number" type="text" id="ad_contact_number" value="<?php echo esc_attr($d['ad_contact_number']); ?>" class="regular-text">
                                <p class="description">Số điện thoại quảng cáo (Mặc định: <code>0908 780 404</code>).</p>
                            </td>
                        </tr>

                        <!-- 3. Ban biên tập -->
                        <tr>
                            <th scope="row">
                                <label for="editorial_board">Ban biên tập</label>
                            </th>
                            <td>
                                <textarea name="editorial_board" id="editorial_board" rows="5" class="large-text" style="max-width: 500px;"><?php echo esc_textarea($editorial_text); ?></textarea>
                                <p class="description">Mỗi dòng một chức vụ và họ tên (5 dòng theo chuẩn Báo Thanh Niên).</p>
                            </td>
                        </tr>

                        <!-- 4. Giấy phép xuất bản & Bản quyền -->
                        <tr>
                            <th scope="row">
                                <label for="license_info">Giấy phép & Bản quyền</label>
                            </th>
                            <td>
                                <textarea name="license_info" id="license_info" rows="3" class="large-text" style="max-width: 600px;"><?php echo esc_textarea($d['license_info']); ?></textarea>
                                <p class="description">Thông tin giấy phép Bộ TTTT và bản quyền chân trang.</p>
                            </td>
                        </tr>

                        <!-- 5. Mạng xã hội -->
                        <tr>
                            <th scope="row">
                                <label for="social_facebook">Facebook URL</label>
                            </th>
                            <td>
                                <input name="social_facebook" type="url" id="social_facebook" value="<?php echo esc_attr($d['social_facebook']); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="social_zalo">Zalo URL</label>
                            </th>
                            <td>
                                <input name="social_zalo" type="url" id="social_zalo" value="<?php echo esc_attr($d['social_zalo']); ?>" class="regular-text">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="social_youtube">YouTube URL</label>
                            </th>
                            <td>
                                <input name="social_youtube" type="url" id="social_youtube" value="<?php echo esc_attr($d['social_youtube']); ?>" class="regular-text">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="submit" style="display: flex; gap: 12px; align-items: center; margin-top: 25px;">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="Lưu thay đổi">
                    <button type="submit" name="thanhnien_reset" value="1" class="button button-secondary" onclick="return confirm('Bạn có chắc muốn khôi phục lại dữ liệu mặc định Báo Thanh Niên?');">
                        Khôi phục mặc định
                    </button>
                    <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button button-link" style="margin-left: 10px;">
                        Xem trang chủ &raquo;
                    </a>
                </p>
            </form>
        </div>
        <?php
    }
}
