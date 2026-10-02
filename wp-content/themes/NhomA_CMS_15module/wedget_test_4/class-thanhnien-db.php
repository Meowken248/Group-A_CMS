<?php
/**
 * Class ThanhNien_Footer_DB
 * 
 * Lớp chuyên trách tầng dữ liệu (Data Access Layer - Repository Pattern)
 * Tuân thủ nguyên tắc Single Responsibility Principle (SRP) trong SOLID.
 * Phụ trách kết nối Database MariaDB/MySQL qua $wpdb, tạo bảng, CRUD và seed dữ liệu Báo Thanh Niên.
 * 
 * @package Widget_Test_4
 * @author Senior Fullstack Engineer
 */

if (!defined('ABSPATH')) {
    exit; // Chống truy cập trực tiếp vì lý do bảo mật
}

class ThanhNien_Footer_DB {

    /**
     * Tên bảng trong database (được thêm tiền tố prefix của WordPress)
     *
     * @var string
     */
    private $table_name;

    /**
     * Phiên bản schema của database
     *
     * @var string
     */
    const DB_VERSION = '1.0.0';

    /**
     * Khởi tạo đối tượng và thiết lập tên bảng
     */
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'thanhnien_footer_settings';
    }

    /**
     * Lấy tên bảng
     *
     * @return string
     */
    public function get_table_name() {
        return $this->table_name;
    }

    /**
     * Tạo bảng cơ sở dữ liệu nếu chưa tồn tại (sử dụng dbDelta chuẩn WordPress)
     */
    public function create_table() {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table_name} (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            setting_key varchar(100) NOT NULL,
            setting_value longtext NOT NULL,
            setting_label varchar(255) DEFAULT '',
            setting_group varchar(50) DEFAULT 'general',
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY setting_key (setting_key)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        // Đánh dấu phiên bản DB
        update_option('thanhnien_footer_db_version', self::DB_VERSION);

        // Tự động chèn dữ liệu mẫu nếu bảng còn trống
        $this->seed_default_data();
    }

    /**
     * Dữ liệu mặc định chuẩn theo hình ảnh Báo Thanh Niên
     *
     * @return array
     */
    public function get_default_data() {
        return array(
            'logo_text' => array(
                'value' => 'THANH NIÊN',
                'label' => 'Tên thương hiệu (Logo text)',
                'group' => 'brand',
            ),
            'tagline' => array(
                'value' => 'DIỄN ĐÀN CỦA HỘI LIÊN HIỆP THANH NIÊN VIỆT NAM',
                'label' => 'Khẩu hiệu / Diễn đàn (Tagline)',
                'group' => 'brand',
            ),
            'nav_datbao' => array(
                'value' => 'https://thanhnien.vn/dat-bao.html',
                'label' => 'Link: Đặt báo',
                'group' => 'navigation',
            ),
            'nav_quangcao' => array(
                'value' => 'https://thanhnien.vn/quang-cao.html',
                'label' => 'Link: Quảng cáo',
                'group' => 'navigation',
            ),
            'nav_rss' => array(
                'value' => 'https://thanhnien.vn/rss.html',
                'label' => 'Link: RSS',
                'group' => 'navigation',
            ),
            'nav_toasoan' => array(
                'value' => 'https://thanhnien.vn/toa-soan.html',
                'label' => 'Link: Tòa soạn',
                'group' => 'navigation',
            ),
            'nav_chinhsach' => array(
                'value' => 'https://thanhnien.vn/chinh-sach-bao-mat.html',
                'label' => 'Link: Chính sách bảo mật',
                'group' => 'navigation',
            ),
            'social_label' => array(
                'value' => 'Theo dõi báo trên',
                'label' => 'Tiêu đề theo dõi mạng xã hội',
                'group' => 'social',
            ),
            'social_facebook' => array(
                'value' => 'https://www.facebook.com/thanhnien',
                'label' => 'Link Facebook',
                'group' => 'social',
            ),
            'social_zalo' => array(
                'value' => 'https://zalo.me/baothanhnien',
                'label' => 'Link Zalo',
                'group' => 'social',
            ),
            'social_youtube' => array(
                'value' => 'https://www.youtube.com/@baothanhnien',
                'label' => 'Link YouTube',
                'group' => 'social',
            ),
            'hotline_title' => array(
                'value' => 'Hotline',
                'label' => 'Tiêu đề Hotline',
                'group' => 'contact',
            ),
            'hotline_number' => array(
                'value' => '0906 645 777',
                'label' => 'Số điện thoại Hotline',
                'group' => 'contact',
            ),
            'ad_contact_title' => array(
                'value' => 'Liên hệ quảng cáo',
                'label' => 'Tiêu đề liên hệ quảng cáo',
                'group' => 'contact',
            ),
            'ad_contact_number' => array(
                'value' => '0908 780 404',
                'label' => 'Số điện thoại liên hệ quảng cáo',
                'group' => 'contact',
            ),
            'editorial_title_1' => array(
                'value' => 'Tổng biên tập: Nguyễn Ngọc Toàn',
                'label' => 'Ban biên tập dòng 1',
                'group' => 'editorial',
            ),
            'editorial_title_2' => array(
                'value' => 'Phó tổng biên tập thường trực: Hải Thành',
                'label' => 'Ban biên tập dòng 2',
                'group' => 'editorial',
            ),
            'editorial_title_3' => array(
                'value' => 'Phó tổng biên tập: Lâm Hiếu Dũng',
                'label' => 'Ban biên tập dòng 3',
                'group' => 'editorial',
            ),
            'editorial_title_4' => array(
                'value' => 'Phó tổng biên tập: Trần Việt Hưng',
                'label' => 'Ban biên tập dòng 4',
                'group' => 'editorial',
            ),
            'editorial_title_5' => array(
                'value' => 'Tổng thư ký tòa soạn: Đức Trung',
                'label' => 'Ban biên tập dòng 5',
                'group' => 'editorial',
            ),
            'license_info' => array(
                'value' => 'Giấy phép xuất bản số 110/GP - BTTTT cấp ngày 24.3.2020 © 2003-2026 Bản quyền thuộc về Báo Thanh Niên. Cấm sao chép dưới mọi hình thức nếu không có sự chấp thuận bằng văn bản.',
                'label' => 'Thông tin Giấy phép & Bản quyền',
                'group' => 'legal',
            ),
            'ncsc_badge_title' => array(
                'value' => 'NCSC CƠ BẢN',
                'label' => 'Tiêu đề chứng chỉ NCSC',
                'group' => 'badge',
            ),
            'ncsc_badge_sub' => array(
                'value' => 'Website đạt chứng nhận TÍN NHIỆM MẠNG',
                'label' => 'Phụ đề chứng chỉ NCSC',
                'group' => 'badge',
            ),
            'ncsc_badge_link' => array(
                'value' => 'https://tinnhiemmang.vn',
                'label' => 'Link xác thực chứng nhận Tín Nhiệm Mạng',
                'group' => 'badge',
            ),
        );
    }

    /**
     * Khởi tạo các giá trị mặc định vào Database nếu chưa có
     */
    public function seed_default_data($force_overwrite = false) {
        global $wpdb;

        $defaults = $this->get_default_data();

        foreach ($defaults as $key => $item) {
            // Kiểm tra xem record đã tồn tại chưa
            $exists = $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM {$this->table_name} WHERE setting_key = %s",
                $key
            ));

            if (!$exists || $force_overwrite) {
                $wpdb->replace(
                    $this->table_name,
                    array(
                        'setting_key'   => sanitize_key($key),
                        'setting_value' => $item['value'],
                        'setting_label' => sanitize_text_field($item['label']),
                        'setting_group' => sanitize_key($item['group']),
                    ),
                    array('%s', '%s', '%s', '%s')
                );
            }
        }
    }

    /**
     * Lấy giá trị của một trường cài đặt từ Database
     *
     * @param string $key Khóa cấu hình
     * @param string $default Giá trị trả về nếu không tìm thấy
     * @return string
     */
    public function get($key, $default = '') {
        global $wpdb;

        // Bảo mật an toàn với Prepared Statement
        $value = $wpdb->get_var($wpdb->prepare(
            "SELECT setting_value FROM {$this->table_name} WHERE setting_key = %s LIMIT 1",
            $key
        ));

        if ($value === null || $value === false) {
            $defaults = $this->get_default_data();
            return isset($defaults[$key]['value']) ? $defaults[$key]['value'] : $default;
        }

        return $value;
    }

    /**
     * Lấy toàn bộ các cấu hình trong Database dưới dạng mảng kết hợp [key => value]
     *
     * @return array
     */
    public function get_all() {
        global $wpdb;

        // Đảm bảo bảng đã tồn tại
        if ($wpdb->get_var("SHOW TABLES LIKE '{$this->table_name}'") != $this->table_name) {
            $this->create_table();
        }

        $results = $wpdb->get_results("SELECT setting_key, setting_value FROM {$this->table_name}", ARRAY_A);

        $data = array();
        if (!empty($results)) {
            foreach ($results as $row) {
                $data[$row['setting_key']] = $row['setting_value'];
            }
        }

        // Bổ sung các giá trị mặc định nếu database thiếu trường
        $defaults = $this->get_default_data();
        foreach ($defaults as $k => $item) {
            if (!isset($data[$k])) {
                $data[$k] = $item['value'];
            }
        }

        return $data;
    }

    /**
     * Cập nhật một trường cài đặt vào Database
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value) {
        global $wpdb;

        $key = sanitize_key($key);
        $defaults = $this->get_default_data();
        $label = isset($defaults[$key]['label']) ? $defaults[$key]['label'] : '';
        $group = isset($defaults[$key]['group']) ? $defaults[$key]['group'] : 'general';

        $result = $wpdb->replace(
            $this->table_name,
            array(
                'setting_key'   => $key,
                'setting_value' => $value,
                'setting_label' => $label,
                'setting_group' => $group,
            ),
            array('%s', '%s', '%s', '%s')
        );

        return $result !== false;
    }

    /**
     * Cập nhật hàng loạt cấu hình từ Form POST của Admin
     *
     * @param array $data Mảng dữ liệu đầu vào [key => value]
     * @return int Số lượng trường đã cập nhật thành công
     */
    public function update_batch(array $data) {
        $count = 0;
        $defaults = $this->get_default_data();

        foreach ($defaults as $key => $item) {
            if (isset($data[$key])) {
                $raw_val = wp_unslash($data[$key]);

                // Xử lý làm sạch dữ liệu tùy thuộc vào kiểu
                if (strpos($key, 'nav_') === 0 || strpos($key, 'social_') === 0 || strpos($key, '_link') !== false) {
                    $clean_val = esc_url_raw(trim($raw_val));
                } else {
                    $clean_val = sanitize_textarea_field(trim($raw_val));
                }

                if ($this->set($key, $clean_val)) {
                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * Khôi phục toàn bộ cài đặt về mặc định từ ảnh mẫu
     */
    public function reset_to_defaults() {
        $this->seed_default_data(true);
    }
}
