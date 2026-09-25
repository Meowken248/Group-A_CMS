<?php
/**
 * Widget Test 4 - Trang Quản Lý (CRUD)
 * Thêm / Sửa / Xóa bài viết hiển thị trong Widget Test 4
 *
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Nhóm A CMS - Branch: Quan_Demo
 */

// Load WordPress
define('WP_USE_THEMES', false);
$wp_load_path = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-load.php';
if (!file_exists($wp_load_path)) {
    die('Không tìm thấy wp-load.php. Vui lòng kiểm tra đường dẫn.');
}
require_once $wp_load_path;
require_once ABSPATH . 'wp-admin/includes/taxonomy.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

// ======================================================
// XỬ LÝ LOGIC CRUD (POST requests)
// ======================================================
$message = '';
$message_type = ''; // success | error | warning

// --- THÊM BÀI VIẾT ---
if (isset($_POST['action']) && $_POST['action'] === 'add_post') {
    $title   = sanitize_text_field($_POST['post_title'] ?? '');
    $content = wp_kses_post($_POST['post_content'] ?? '');
    $excerpt = sanitize_text_field($_POST['post_excerpt'] ?? '');
    $cat_id  = intval($_POST['post_category'] ?? 0);

    if (empty($title)) {
        $message = 'Tiêu đề không được để trống!';
        $message_type = 'error';
    } else {
        $post_id = wp_insert_post(array(
            'post_title'    => $title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_status'   => 'publish',
            'post_type'     => 'post',
            'post_author'   => 1,
            'post_category' => $cat_id > 0 ? array($cat_id) : array(),
        ));

        if (!is_wp_error($post_id) && $post_id > 0) {
            // Upload thumbnail nếu có
            if (!empty($_FILES['post_thumbnail']['name'])) {
                $attach_id = media_handle_upload('post_thumbnail', $post_id);
                if (!is_wp_error($attach_id)) {
                    set_post_thumbnail($post_id, $attach_id);
                }
            }
            $message = "Thêm bài viết thành công! (ID=$post_id)";
            $message_type = 'success';
        } else {
            $message = 'Lỗi khi thêm bài viết: ' . ($post_id instanceof WP_Error ? $post_id->get_error_message() : 'Unknown');
            $message_type = 'error';
        }
    }
}

// --- SỬA BÀI VIẾT ---
if (isset($_POST['action']) && $_POST['action'] === 'edit_post') {
    $post_id = intval($_POST['post_id'] ?? 0);
    $title   = sanitize_text_field($_POST['post_title'] ?? '');
    $content = wp_kses_post($_POST['post_content'] ?? '');
    $excerpt = sanitize_text_field($_POST['post_excerpt'] ?? '');
    $cat_id  = intval($_POST['post_category'] ?? 0);

    if ($post_id <= 0 || empty($title)) {
        $message = 'Dữ liệu không hợp lệ!';
        $message_type = 'error';
    } else {
        $result = wp_update_post(array(
            'ID'            => $post_id,
            'post_title'    => $title,
            'post_content'  => $content,
            'post_excerpt'  => $excerpt,
            'post_category' => $cat_id > 0 ? array($cat_id) : array(),
        ));

        if (!is_wp_error($result)) {
            // Upload thumbnail mới nếu có
            if (!empty($_FILES['post_thumbnail']['name'])) {
                $attach_id = media_handle_upload('post_thumbnail', $post_id);
                if (!is_wp_error($attach_id)) {
                    set_post_thumbnail($post_id, $attach_id);
                }
            }
            $message = "Cập nhật bài viết ID=$post_id thành công!";
            $message_type = 'success';
        } else {
            $message = 'Lỗi cập nhật: ' . $result->get_error_message();
            $message_type = 'error';
        }
    }
}

// --- XÓA BÀI VIẾT ---
if (isset($_GET['delete']) && intval($_GET['delete']) > 0) {
    $del_id = intval($_GET['delete']);
    $del_post = get_post($del_id);
    if ($del_post) {
        wp_delete_post($del_id, true); // true = xóa vĩnh viễn
        $message = "Đã xóa bài viết \"" . esc_html($del_post->post_title) . "\" (ID=$del_id)!";
        $message_type = 'warning';
    }
}

// --- THÊM CHUYÊN MỤC ---
if (isset($_POST['action']) && $_POST['action'] === 'add_category') {
    $cat_name = sanitize_text_field($_POST['cat_name'] ?? '');
    if (!empty($cat_name)) {
        $existing = term_exists($cat_name, 'category');
        if ($existing) {
            $message = "Chuyên mục \"$cat_name\" đã tồn tại!";
            $message_type = 'warning';
        } else {
            $result = wp_insert_term($cat_name, 'category');
            if (!is_wp_error($result)) {
                $message = "Thêm chuyên mục \"$cat_name\" thành công! (ID={$result['term_id']})";
                $message_type = 'success';
            } else {
                $message = 'Lỗi: ' . $result->get_error_message();
                $message_type = 'error';
            }
        }
    }
}

// --- XÓA CHUYÊN MỤC ---
if (isset($_GET['delete_cat']) && intval($_GET['delete_cat']) > 1) {
    $del_cat_id = intval($_GET['delete_cat']);
    $del_cat = get_term($del_cat_id, 'category');
    if ($del_cat && !is_wp_error($del_cat)) {
        wp_delete_term($del_cat_id, 'category');
        $message = "Đã xóa chuyên mục \"{$del_cat->name}\"!";
        $message_type = 'warning';
    }
}

// ======================================================
// LẤY DỮ LIỆU ĐỂ HIỂN THỊ
// ======================================================

// Lấy tất cả categories
$all_categories = get_categories(array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'hide_empty' => false,
));

// Lấy filter category
$filter_cat = isset($_GET['cat']) ? intval($_GET['cat']) : 0;

// Lấy bài viết
$query_args = array(
    'posts_per_page' => 50,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);
if ($filter_cat > 0) {
    $query_args['cat'] = $filter_cat;
}
$all_posts = get_posts($query_args);

// Lấy bài viết đang sửa (nếu có)
$editing_post = null;
if (isset($_GET['edit']) && intval($_GET['edit']) > 0) {
    $editing_post = get_post(intval($_GET['edit']));
}

// URL hiện tại
$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Widget Test 4 - Nhóm A CMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f0f2f5;
            color: #1a1a2e;
            margin: 0;
            padding: 0;
        }

        /* ===== HEADER ===== */
        .admin-header {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #fff;
            padding: 20px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .admin-header h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
        }
        .admin-header p {
            opacity: 0.8;
            margin: 5px 0 0;
            font-size: 14px;
        }
        .admin-header .badge-pill {
            font-size: 11px;
            vertical-align: middle;
        }

        /* ===== NAV LINKS ===== */
        .nav-back {
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 0;
        }
        .nav-back a {
            color: #0f3460;
            font-weight: 600;
            text-decoration: none;
            font-size: 14px;
        }
        .nav-back a:hover { color: #e53935; }

        /* ===== CONTENT ===== */
        .admin-content {
            max-width: 1200px;
            margin: 25px auto;
            padding: 0 15px;
        }

        /* ===== CARDS ===== */
        .admin-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            overflow: hidden;
            border: 1px solid #e8ecf1;
        }
        .admin-card-header {
            background: linear-gradient(135deg, #f8f9fb 0%, #eef1f5 100%);
            padding: 15px 20px;
            border-bottom: 1px solid #e0e4ea;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .admin-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            color: #1a1a2e;
        }
        .admin-card-header .icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #fff;
        }
        .icon-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .icon-green { background: linear-gradient(135deg, #22c55e, #16a34a); }
        .icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
        .icon-red { background: linear-gradient(135deg, #ef4444, #dc2626); }

        .admin-card-body {
            padding: 20px;
        }

        /* ===== FORM ===== */
        .form-group label {
            font-weight: 600;
            font-size: 13px;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 8px;
            border: 1.5px solid #d1d5db;
            padding: 10px 14px;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        /* ===== BUTTONS ===== */
        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .btn-primary-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            color: #fff;
        }
        .btn-success-custom {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
            color: #fff;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-success-custom:hover { color: #fff; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3); }
        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }
        .btn-danger-custom:hover { color: #fff; box-shadow: 0 3px 10px rgba(220, 38, 38, 0.3); }
        .btn-edit {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }
        .btn-edit:hover { color: #fff; box-shadow: 0 3px 10px rgba(217, 119, 6, 0.3); }

        /* ===== TABLE ===== */
        .table-posts {
            margin: 0;
        }
        .table-posts thead th {
            background: #f8f9fb;
            border-bottom: 2px solid #e0e4ea;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 700;
            padding: 12px 16px;
        }
        .table-posts tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        .table-posts tbody tr:hover {
            background: #f8faff;
        }
        .table-posts .post-title-cell {
            font-weight: 600;
            color: #1e293b;
            max-width: 350px;
        }
        .table-posts .post-title-cell a {
            color: #1e293b;
            text-decoration: none;
        }
        .table-posts .post-title-cell a:hover {
            color: #3b82f6;
        }
        .post-thumb-mini {
            width: 50px;
            height: 35px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        .no-thumb {
            width: 50px;
            height: 35px;
            border-radius: 4px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 11px;
        }

        /* ===== ALERT ===== */
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ===== BADGE ===== */
        .cat-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        /* ===== CATEGORY LIST ===== */
        .cat-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }
        .cat-list-item:last-child { border-bottom: none; }
        .cat-list-item:hover { background: #f8faff; }
        .cat-count {
            font-size: 12px;
            color: #94a3b8;
        }

        /* ===== FILTER ===== */
        .filter-bar {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 15px;
        }
        .filter-btn {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            border: 1.5px solid #d1d5db;
            background: #fff;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s;
        }
        .filter-btn:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            text-decoration: none;
        }
        .filter-btn.active {
            background: #3b82f6;
            color: #fff;
            border-color: #3b82f6;
        }

        /* ===== STATS ===== */
        .stats-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .stat-card {
            flex: 1;
            min-width: 140px;
            background: #fff;
            border-radius: 10px;
            padding: 16px;
            border: 1px solid #e8ecf1;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .stat-card .stat-number {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
        }
        .stat-card .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }
        .stat-blue .stat-number { color: #2563eb; }
        .stat-green .stat-number { color: #16a34a; }
        .stat-orange .stat-number { color: #d97706; }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="admin-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h1><i class="fas fa-cogs mr-2"></i>Quản lý Widget Test 4
                    <span class="badge badge-pill badge-light ml-2">CRUD</span>
                </h1>
                <p>Thêm / Sửa / Xóa bài viết và chuyên mục hiển thị trong Widget</p>
            </div>
            <div>
                <a href="<?php echo home_url('/'); ?>" class="btn btn-outline-light btn-sm" target="_blank">
                    <i class="fas fa-external-link-alt mr-1"></i> Xem Trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- NAV BACK -->
<div class="nav-back">
    <div class="container">
        <a href="<?php echo home_url('/'); ?>"><i class="fas fa-arrow-left mr-1"></i> Quay về Trang chủ</a>
        <span class="mx-2 text-muted">|</span>
        <a href="<?php echo $current_url; ?>"><i class="fas fa-sync-alt mr-1"></i> Làm mới trang</a>
    </div>
</div>

<div class="admin-content">

    <!-- THÔNG BÁO -->
    <?php if (!empty($message)) : ?>
        <div class="alert alert-custom alert-<?php echo $message_type === 'success' ? 'success' : ($message_type === 'error' ? 'danger' : 'warning'); ?> alert-dismissible fade show">
            <i class="fas fa-<?php echo $message_type === 'success' ? 'check-circle' : ($message_type === 'error' ? 'exclamation-circle' : 'exclamation-triangle'); ?>"></i>
            <?php echo esc_html($message); ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <!-- THỐNG KÊ -->
    <div class="stats-row">
        <div class="stat-card stat-blue">
            <div class="stat-number"><?php echo count($all_posts); ?></div>
            <div class="stat-label">Bài viết</div>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-number"><?php echo count($all_categories); ?></div>
            <div class="stat-label">Chuyên mục</div>
        </div>
        <div class="stat-card stat-orange">
            <div class="stat-number">
                <?php
                $thumb_count = 0;
                foreach ($all_posts as $p) { if (has_post_thumbnail($p->ID)) $thumb_count++; }
                echo $thumb_count;
                ?>
            </div>
            <div class="stat-label">Có ảnh đại diện</div>
        </div>
    </div>

    <div class="row">
        <!-- CỘT TRÁI: FORM + CHUYÊN MỤC -->
        <div class="col-lg-5 mb-4">

            <!-- FORM THÊM / SỬA BÀI VIẾT -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="icon <?php echo $editing_post ? 'icon-orange' : 'icon-green'; ?>">
                        <i class="fas fa-<?php echo $editing_post ? 'edit' : 'plus'; ?>"></i>
                    </div>
                    <h3><?php echo $editing_post ? 'Sửa bài viết (ID=' . $editing_post->ID . ')' : 'Thêm bài viết mới'; ?></h3>
                </div>
                <div class="admin-card-body">
                    <form method="POST" action="<?php echo esc_url($current_url); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="<?php echo $editing_post ? 'edit_post' : 'add_post'; ?>">
                        <?php if ($editing_post) : ?>
                            <input type="hidden" name="post_id" value="<?php echo $editing_post->ID; ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="post_title"><i class="fas fa-heading mr-1"></i> Tiêu đề *</label>
                            <input type="text" name="post_title" id="post_title" class="form-control" required
                                   placeholder="Nhập tiêu đề bài viết..."
                                   value="<?php echo $editing_post ? esc_attr($editing_post->post_title) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_category"><i class="fas fa-folder mr-1"></i> Chuyên mục</label>
                            <select name="post_category" id="post_category" class="form-control">
                                <option value="0">-- Chọn chuyên mục --</option>
                                <?php
                                $edit_cats = $editing_post ? wp_get_post_categories($editing_post->ID) : array();
                                foreach ($all_categories as $cat) :
                                    if ($cat->slug === 'uncategorized') continue;
                                    $selected = in_array($cat->term_id, $edit_cats) ? 'selected' : '';
                                ?>
                                    <option value="<?php echo $cat->term_id; ?>" <?php echo $selected; ?>>
                                        <?php echo esc_html($cat->name); ?> (<?php echo $cat->count; ?> bài)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="post_excerpt"><i class="fas fa-align-left mr-1"></i> Tóm tắt</label>
                            <textarea name="post_excerpt" id="post_excerpt" class="form-control" rows="2"
                                      placeholder="Nhập tóm tắt ngắn..."><?php echo $editing_post ? esc_textarea($editing_post->post_excerpt) : ''; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="post_content"><i class="fas fa-file-alt mr-1"></i> Nội dung</label>
                            <textarea name="post_content" id="post_content" class="form-control" rows="4"
                                      placeholder="Nhập nội dung chi tiết..."><?php echo $editing_post ? esc_textarea($editing_post->post_content) : ''; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="post_thumbnail"><i class="fas fa-image mr-1"></i> Ảnh đại diện (Thumbnail)</label>
                            <?php if ($editing_post && has_post_thumbnail($editing_post->ID)) : ?>
                                <div class="mb-2">
                                    <img src="<?php echo get_the_post_thumbnail_url($editing_post->ID, 'thumbnail'); ?>" 
                                         class="post-thumb-mini" alt="Current thumbnail">
                                    <small class="text-muted ml-2">Ảnh hiện tại (chọn ảnh mới để thay thế)</small>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="post_thumbnail" id="post_thumbnail" class="form-control-file" accept="image/*">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn <?php echo $editing_post ? 'btn-edit' : 'btn-success-custom'; ?>">
                                <i class="fas fa-<?php echo $editing_post ? 'save' : 'plus-circle'; ?> mr-1"></i>
                                <?php echo $editing_post ? 'Cập nhật' : 'Thêm bài viết'; ?>
                            </button>
                            <?php if ($editing_post) : ?>
                                <a href="<?php echo $current_url; ?>" class="btn btn-secondary ml-2">
                                    <i class="fas fa-times mr-1"></i> Hủy
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- QUẢN LÝ CHUYÊN MỤC -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="icon icon-blue"><i class="fas fa-folder-plus"></i></div>
                    <h3>Quản lý chuyên mục</h3>
                </div>
                <div class="admin-card-body">
                    <!-- Form thêm chuyên mục -->
                    <form method="POST" action="<?php echo esc_url($current_url); ?>" class="mb-3">
                        <input type="hidden" name="action" value="add_category">
                        <div class="input-group">
                            <input type="text" name="cat_name" class="form-control" placeholder="Tên chuyên mục mới..." required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary-custom">
                                    <i class="fas fa-plus"></i> Thêm
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Danh sách chuyên mục -->
                    <div class="border rounded" style="border-radius: 8px !important; overflow: hidden;">
                        <?php foreach ($all_categories as $cat) : ?>
                            <div class="cat-list-item">
                                <div>
                                    <strong><?php echo esc_html($cat->name); ?></strong>
                                    <span class="cat-count ml-2">(<?php echo $cat->count; ?> bài)</span>
                                </div>
                                <?php if ($cat->slug !== 'uncategorized') : ?>
                                    <a href="<?php echo $current_url . '?delete_cat=' . $cat->term_id; ?>"
                                       class="btn btn-danger-custom btn-sm"
                                       onclick="return confirm('Xóa chuyên mục \'<?php echo esc_js($cat->name); ?>\'?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php else : ?>
                                    <small class="text-muted">Mặc định</small>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- CỘT PHẢI: DANH SÁCH BÀI VIẾT -->
        <div class="col-lg-7 mb-4">
            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="icon icon-blue"><i class="fas fa-list"></i></div>
                    <h3>Danh sách bài viết (<?php echo count($all_posts); ?>)</h3>
                </div>
                <div class="admin-card-body">
                    <!-- FILTER -->
                    <div class="filter-bar">
                        <span class="text-muted mr-1" style="font-size: 13px;"><i class="fas fa-filter mr-1"></i>Lọc:</span>
                        <a href="<?php echo $current_url; ?>" class="filter-btn <?php echo $filter_cat === 0 ? 'active' : ''; ?>">
                            Tất cả
                        </a>
                        <?php foreach ($all_categories as $cat) :
                            if ($cat->slug === 'uncategorized') continue;
                        ?>
                            <a href="<?php echo $current_url . '?cat=' . $cat->term_id; ?>"
                               class="filter-btn <?php echo $filter_cat === (int)$cat->term_id ? 'active' : ''; ?>">
                                <?php echo esc_html($cat->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <?php if (empty($all_posts)) : ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                            <p>Chưa có bài viết nào. Hãy thêm bài viết mới!</p>
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-posts">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Chuyên mục</th>
                                        <th>Ngày</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_posts as $post) :
                                        $post_cats = wp_get_post_categories($post->ID, array('fields' => 'all'));
                                    ?>
                                        <tr>
                                            <td><strong><?php echo $post->ID; ?></strong></td>
                                            <td>
                                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'thumbnail'); ?>"
                                                         class="post-thumb-mini" alt="thumb">
                                                <?php else : ?>
                                                    <div class="no-thumb"><i class="fas fa-image"></i></div>
                                                <?php endif; ?>
                                            </td>
                                            <td class="post-title-cell">
                                                <a href="<?php echo get_permalink($post->ID); ?>" target="_blank">
                                                    <?php echo esc_html($post->post_title); ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php foreach ($post_cats as $pc) : ?>
                                                    <span class="cat-badge"><?php echo esc_html($pc->name); ?></span>
                                                <?php endforeach; ?>
                                            </td>
                                            <td style="white-space: nowrap; font-size: 13px; color: #64748b;">
                                                <?php echo date('d/m/Y', strtotime($post->post_date)); ?>
                                            </td>
                                            <td style="white-space: nowrap;">
                                                <a href="<?php echo $current_url . '?edit=' . $post->ID; ?>" class="btn btn-edit btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="<?php echo $current_url . '?delete=' . $post->ID; ?>" class="btn btn-danger-custom btn-sm"
                                                   onclick="return confirm('Xóa bài viết \'<?php echo esc_js($post->post_title); ?>\'?\nHành động này không thể hoàn tác!');">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="text-center py-4 text-muted" style="font-size: 13px;">
    <p>&copy; <?php echo date('Y'); ?> - <strong>Widget Test 4 Admin</strong> | Nhóm A CMS - Bùi Nguyễn Minh Quân | FIT TDC</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
