<?php
/**
 * ==========================================================
 * MODULE 14: COMMENTS (BÌNH LUẬN BÀI VIẾT)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/14/test.php
 * Thiết kế chuẩn mẫu Bootsnipp gNVj0 theo đúng tài liệu đánh giá (PDF Trang 11)
 * ==========================================================
 */

if (!function_exists('get_header')) {
    $wp_load_path = dirname(__DIR__, 4) . '/wp-load.php';
    if (file_exists($wp_load_path)) {
        require_once $wp_load_path;
    }
}

$module14_is_standalone = !did_action('get_header');
if ($module14_is_standalone && function_exists('get_header')) {
    get_header();
}

$comments_query = get_comments([
    'status' => 'approve',
    'number' => 8,
    'order'  => 'ASC',
]);

// Dữ liệu mẫu dự phòng (Fallback) đúng chuẩn theo ảnh đề bài PDF Trang 11
$lorem_default = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";

$fallback_comments = [
    [
        'id'       => 101,
        'author'   => 'John Doe',
        'content'  => $lorem_default,
        'date'     => '10 phút trước',
        'children' => [
            [
                'id'       => 102,
                'author'   => 'Jane Doe',
                'content'  => $lorem_default,
                'date'     => '5 phút trước',
                'children' => []
            ]
        ]
    ],
    [
        'id'       => 103,
        'author'   => 'John Doe',
        'content'  => $lorem_default,
        'date'     => 'Vừa xong',
        'children' => []
    ]
];
?>

<style>
    .module-14-widget {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }

    .module-14-widget-header {
        background: #f8fafc;
        border-bottom: 2px solid #005baa;
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .module-14-widget-title {
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

    .module-14-widget-body {
        padding: 12px;
    }

    .module-14-list-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Thẻ bình luận chuẩn Bootsnipp gNVj0 */
    .module-14-comment-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 10px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .module-14-comment-box:hover {
        border-color: #cbd5e1;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    /* Khối vuông avatar màu xám có icon người dùng theo mẫu */
    .module-14-avatar-box {
        flex: 0 0 38px;
        width: 38px;
        height: 38px;
        background-color: #cbd5e1;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 18px;
        overflow: hidden;
    }

    .module-14-avatar-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Nội dung bình luận bên phải */
    .module-14-comment-content {
        flex: 1;
        min-width: 0;
    }

    /* Tên tác giả in đậm */
    .module-14-author-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
        line-height: 1.3;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    /* Đoạn văn bình luận */
    .module-14-text-body {
        font-size: 12px;
        color: #475569;
        line-height: 1.45;
        margin: 0;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .module-14-text-body p {
        margin: 0;
    }

    .module-14-meta-info {
        margin-top: 5px;
        font-size: 11px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Bình luận con thụt lề vào trong (Nested child comment Jane Doe) */
    .module-14-nested-replies {
        margin-left: 18px;
        border-left: 2px solid #e2e8f0;
        padding-left: 6px;
        margin-top: 6px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .module-14-nested-replies .module-14-avatar-box {
        flex: 0 0 32px;
        width: 32px;
        height: 32px;
        font-size: 15px;
    }

    .module-14-nested-replies .module-14-comment-box {
        padding: 8px;
    }

    /* Form gửi bình luận nhanh khi xem độc lập */
    .module-14-quick-form {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 14px;
        margin-top: 15px;
    }

    .module-14-quick-form h5 {
        font-size: 13.5px;
        font-weight: 700;
        color: #005baa;
        margin-bottom: 8px;
    }

    .module-14-input {
        width: 100%;
        padding: 6px 9px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 12.5px;
        margin-bottom: 8px;
        outline: none;
    }

    .module-14-btn-submit {
        background: #005baa;
        color: #ffffff;
        border: none;
        padding: 6px 14px;
        border-radius: 4px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
    }
</style>

<div class="module-14-widget <?php echo ($module14_is_standalone ? 'container my-4' : ''); ?>">
    <div class="module-14-widget-header">
        <h3 class="module-14-widget-title">
            <i class="fa-regular fa-comments"></i> Comments
        </h3>
    </div>

    <div class="module-14-widget-body">
        <div class="module-14-list-container">
            <?php
            if (!function_exists('render_module_14_comment_item')) {
                function render_module_14_comment_item($author, $content, $date = '', $comment_id = 0, $is_nested = false) {
                    $trimmed = wp_trim_words($content, 20, '...');
                    ?>
                    <div class="module-14-comment-box <?php echo $is_nested ? 'is-nested' : ''; ?>" id="comment-<?php echo esc_attr($comment_id); ?>">
                        <!-- CỘT TRÁI: AVATAR XÁM CÓ ICON THEO MẪU -->
                        <div class="module-14-avatar-box">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <!-- CỘT PHẢI: TÊN TÁC GIẢ IN ĐẬM & NỘI DUNG -->
                        <div class="module-14-comment-content">
                            <h4 class="module-14-author-name"><?php echo esc_html($author); ?></h4>
                            <div class="module-14-text-body">
                                <p><?php echo esc_html($trimmed); ?></p>
                            </div>
                            <div class="module-14-meta-info">
                                <?php if ($date) : ?>
                                    <span><i class="fa-regular fa-clock mr-1"></i><?php echo esc_html($date); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }

            if (!empty($comments_query)) {
                $m14_parents = [];
                $m14_children = [];

                foreach ($comments_query as $c) {
                    if ($c->comment_parent == 0) {
                        $m14_parents[] = $c;
                    } else {
                        $m14_children[$c->comment_parent][] = $c;
                    }
                }

                foreach ($m14_parents as $parent) {
                    render_module_14_comment_item(
                        $parent->comment_author,
                        $parent->comment_content,
                        human_time_diff(strtotime($parent->comment_date), current_time('timestamp')) . ' trước',
                        $parent->comment_ID,
                        false
                    );

                    if (!empty($m14_children[$parent->comment_ID])) {
                        echo '<div class="module-14-nested-replies">';
                        foreach ($m14_children[$parent->comment_ID] as $child) {
                            render_module_14_comment_item(
                                $child->comment_author,
                                $child->comment_content,
                                human_time_diff(strtotime($child->comment_date), current_time('timestamp')) . ' trước',
                                $child->comment_ID,
                                true
                            );
                        }
                        echo '</div>';
                    }
                }
            } else {
                // FALLBACK CHUẨN ĐÚNG THEO ẢNH ĐỀ BÀI BOOTSNIPP gNVj0 (John Doe, Jane Doe thụt lề, John Doe)
                foreach ($fallback_comments as $fb) {
                    render_module_14_comment_item($fb['author'], $fb['content'], $fb['date'], $fb['id'], false);

                    if (!empty($fb['children'])) {
                        echo '<div class="module-14-nested-replies">';
                        foreach ($fb['children'] as $child) {
                            render_module_14_comment_item($child['author'], $child['content'], $child['date'], $child['id'], true);
                        }
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>

        <?php if ($module14_is_standalone) : ?>
        <div class="module-14-quick-form">
            <h5><i class="fa-solid fa-pen-to-square mr-1"></i> Để lại bình luận</h5>
            <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post">
                <input type="hidden" name="comment_post_ID" value="1">
                <input type="text" name="author" class="module-14-input" placeholder="Họ và tên *" required>
                <input type="email" name="email" class="module-14-input" placeholder="Email *" required>
                <textarea name="comment" rows="3" class="module-14-input" placeholder="Nội dung bình luận *" required></textarea>
                <button type="submit" class="module-14-btn-submit">Gửi bình luận</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
if ($module14_is_standalone && function_exists('get_footer')) {
    get_footer();
}
?>
