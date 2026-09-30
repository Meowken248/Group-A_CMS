<?php
/**
 * ==========================================================
 * MODULE 16: THỐNG KÊ CSDL & TRANG LIÊN KẾT NHANH (DYNAMIC DATABASE)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/16/test.php
 * Module có KẾT NỐI VÀ TRUY VẤN DỮ LIỆU ĐỘNG TỪ DATABASE WORDPRESS:
 *   1. wp_count_posts('post'): Lấy tổng bài viết từ CSDL (bảng wp_posts)
 *   2. wp_count_posts('page'): Lấy tổng số trang từ CSDL (bảng wp_posts)
 *   3. wp_count_comments(): Lấy tổng số bình luận duyệt từ CSDL (bảng wp_comments)
 *   4. get_pages(): Truy vấn danh sách các Trang đào tạo từ CSDL kèm permalink động
 * ==========================================================
 */

// Tự động nạp môi trường WordPress nếu chạy độc lập
if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

$module16_is_standalone = !did_action('get_header');
if ($module16_is_standalone && function_exists('get_header')) {
    get_header();
}

// ==========================================================
// 1. TRUY VẤN DỮ LIỆU ĐỘNG TỪ DATABASE WORDPRESS
// ==========================================================
// Xử lý lưu email đăng ký nhận tin vào Database (bảng wp_options)
$newsletter_feedback = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['m16_email'])) {
    $submitted_email = sanitize_email($_POST['m16_email']);
    if (is_email($submitted_email)) {
        $subscribers = get_option('nhom_a_newsletter_subscribers', []);
        if (!is_array($subscribers)) {
            $subscribers = [];
        }

        $is_existed = false;
        foreach ($subscribers as $sub) {
            if (isset($sub['email']) && strtolower($sub['email']) === strtolower($submitted_email)) {
                $is_existed = true;
                break;
            }
        }

        if (!$is_existed) {
            $subscribers[] = [
                'email' => $submitted_email,
                'created_at' => current_time('mysql'),
            ];
            update_option('nhom_a_newsletter_subscribers', $subscribers);
            $newsletter_feedback = [
                'status'  => 'success',
                'message' => 'Đã lưu thành công email ' . esc_html($submitted_email) . ' vào CSDL!'
            ];
        } else {
            $newsletter_feedback = [
                'status'  => 'warning',
                'message' => 'Email này đã có trong danh sách CSDL!'
            ];
        }
    } else {
        $newsletter_feedback = [
            'status'  => 'danger',
            'message' => 'Email không đúng định dạng!'
        ];
    }

    // Nếu gửi bằng AJAX thì trả về JSON
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        wp_send_json($newsletter_feedback);
        exit;
    }
}

$count_posts_obj = wp_count_posts('post');
$total_posts     = isset($count_posts_obj->publish) ? (int)$count_posts_obj->publish : 0;

$count_pages_obj = wp_count_posts('page');
$total_pages     = isset($count_pages_obj->publish) ? (int)$count_pages_obj->publish : 0;

$count_comments_obj = wp_count_comments();
$total_comments     = isset($count_comments_obj->approved) ? (int)$count_comments_obj->approved : 0;

$user_counts = count_users();
$total_users = isset($user_counts['total_users']) ? (int)$user_counts['total_users'] : 1;

// Lấy danh sách 3 trang mới nhất từ database (loại bỏ các trang module ảo nếu có)
$dynamic_pages = get_pages([
    'sort_column'  => 'post_date',
    'sort_order'   => 'ASC',
    'number'       => 3,
    'post_status'  => 'publish',
    'exclude'      => [17, 18, 19]
]);
?>

<style>
    .module-16-widget {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 22px 25px;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .module-16-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #005baa;
        padding-bottom: 10px;
        margin-bottom: 18px;
    }

    .module-16-title {
        font-size: 17px;
        font-weight: 700;
        color: #005baa;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .module-16-badge-db {
        font-size: 11.5px;
        font-weight: 600;
        background: #e0f2fe;
        color: #0369a1;
        padding: 4px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    /* Khối thống kê 4 cột lấy từ Database */
    .module-16-stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .module-16-stat-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .module-16-stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        border-color: #cbd5e1;
    }

    .module-16-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .module-16-stat-icon.blue { background: #e0f2fe; color: #005baa; }
    .module-16-stat-icon.green { background: #dcfce7; color: #166534; }
    .module-16-stat-icon.purple { background: #f3e8ff; color: #7e22ce; }
    .module-16-stat-icon.amber { background: #fef3c7; color: #b45309; }

    .module-16-stat-info h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.1;
    }

    .module-16-stat-info span {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
    }

    /* Khối liên kết động lấy từ DB + Newsletter */
    .module-16-bottom-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
        align-items: center;
    }

    .module-16-links-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .module-16-dynamic-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        color: #1e293b;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .module-16-dynamic-link:hover {
        background: #005baa;
        color: #ffffff;
        border-color: #005baa;
        text-decoration: none;
    }

    /* Form nhận tin */
    .module-16-newsletter {
        background: #f1f5f9;
        border-radius: 6px;
        padding: 10px 14px;
        display: flex;
        gap: 6px;
    }

    .module-16-newsletter input {
        flex: 1;
        padding: 6px 10px;
        font-size: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        outline: none;
    }

    .module-16-newsletter button {
        background: #005baa;
        color: #ffffff;
        border: none;
        padding: 6px 14px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .module-16-newsletter button:hover {
        background: #004480;
    }

    @media (max-width: 992px) {
        .module-16-stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
        .module-16-bottom-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .module-16-stats-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="module-16-widget <?php echo ($module16_is_standalone ? 'container my-4' : ''); ?>">

    <!-- 1. HÀNG THỐNG KÊ LẤY TRỰC TIẾP TỪ DATABASE WORDPRESS -->
    <div class="module-16-stats-row">
        <!-- Thống kê Bài viết -->
        <div class="module-16-stat-card">
            <div class="module-16-stat-info">
                <h4><?php echo esc_html($total_posts); ?></h4>
                <span>Bài viết</span>
            </div>
        </div>

        <!-- Thống kê Trang đào tạo -->
        <div class="module-16-stat-card">
            <div class="module-16-stat-info">
                <h4><?php echo esc_html($total_pages); ?></h4>
                <span>Trang đào tạo</span>
            </div>
        </div>

        <!-- Thống kê Bình luận -->
        <div class="module-16-stat-card">
            <div class="module-16-stat-info">
                <h4><?php echo esc_html($total_comments); ?></h4>
                <span>Bình luận</span>
            </div>
        </div>

        <!-- Thống kê Thành viên -->
        <div class="module-16-stat-card">
            <div class="module-16-stat-info">
                <h4><?php echo esc_html($total_users); ?></h4>
                <span>Thành viên</span>
            </div>
        </div>
    </div>

    <!-- 2. LIÊN KẾT NHANH TỚI CÁC TRANG CỦA DATABASE + ĐĂNG KÝ BẢN TIN -->
    <div class="module-16-bottom-row">
        <div class="module-16-links-list">
            <?php if (!empty($dynamic_pages)) : ?>
                <?php foreach ($dynamic_pages as $dp) : ?>
                    <a href="<?php echo esc_url(get_permalink($dp->ID)); ?>" class="module-16-dynamic-link" title="<?php echo esc_attr($dp->post_title); ?>">
                        <?php echo esc_html($dp->post_title); ?>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="module-16-dynamic-link">
                    Trang chủ
                </a>
            <?php endif; ?>
        </div>

        <div>
            <form class="module-16-newsletter" method="post" id="form-module-16-newsletter">
                <input type="email" name="m16_email" id="m16_input_email" placeholder="Nhập email nhận tin..." required>
                <button type="submit" id="m16_btn_submit">Đăng ký</button>
            </form>
            <div id="m16-newsletter-alert" style="margin-top: 6px; font-size: 12px; font-weight: 600; display: none;"></div>
            <?php if ($newsletter_feedback) : ?>
                <div style="margin-top: 6px; font-size: 12px; font-weight: 600; color: <?php echo $newsletter_feedback['status'] === 'success' ? '#16a34a' : ($newsletter_feedback['status'] === 'warning' ? '#d97706' : '#dc2626'); ?>">
                    <?php echo esc_html($newsletter_feedback['message']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('form-module-16-newsletter');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var emailInput = document.getElementById('m16_input_email');
        var btn = document.getElementById('m16_btn_submit');
        var alertBox = document.getElementById('m16-newsletter-alert');
        var email = emailInput.value.trim();
        if (!email) return;

        btn.disabled = true;
        btn.innerText = 'Đang lưu...';

        var formData = new FormData();
        formData.append('m16_email', email);

        fetch(window.location.href, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.innerText = 'Đăng ký';
            alertBox.style.display = 'block';
            alertBox.innerText = data.message;
            if (data.status === 'success') {
                alertBox.style.color = '#16a34a';
                emailInput.value = '';
            } else if (data.status === 'warning') {
                alertBox.style.color = '#d97706';
            } else {
                alertBox.style.color = '#dc2626';
            }
        })
        .catch(function() {
            btn.disabled = false;
            btn.innerText = 'Đăng ký';
            form.submit(); // Fallback gửi form thường nếu fetch gặp lỗi
        });
    });
});
</script>

<?php
if ($module16_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
