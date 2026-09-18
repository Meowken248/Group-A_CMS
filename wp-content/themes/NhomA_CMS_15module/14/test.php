<?php
/**
 * ==========================================================
 * MODULE 14: COMMENTS (BÌNH LUẬN BÀI VIẾT)
 * Đường dẫn: C:\Users\Admin\source\Group-A_CMS\wp-content\themes\NhomA_CMS_15module\14\test.php
 * Thiết kế chuẩn giao diện tin tức / chuyên mục FIT - Cao đẳng Công nghệ Thủ Đức (TDC)
 * Nguồn cảm hứng: Bootsnipp Bootstrap Comment List / Media Object
 * 
 * YÊU CẦU ĐỀ BÀI:
 * - Trước chỉnh sửa: Giao diện bình luận mặc định của WordPress (thô sơ, font chữ nhỏ)
 * - Sau chỉnh sửa:
 *   + Tùy biến từng bình luận thành Card chuyên nghiệp (Bootsnipp style)
 *   + Cột trái: Avatar người dùng (Khối xám có icon người dùng chuẩn nhận diện)
 *   + Cột phải: Họ tên tác giả in đậm (John Doe, Jane Doe) và nội dung bình luận
 *   + Hỗ trợ bình luận phân cấp lồng nhau (Nested / Child Reply): Bình luận phản hồi thụt lùi vào trong
 * ==========================================================
 */

// Lấy ID bài viết hiện tại hoặc mặc định post #1 ("Hello world!")
$current_post_id = get_the_ID() ? get_the_ID() : 1;

// Lấy danh sách bình luận đã duyệt
$comments_query = get_comments([
    'post_id' => $current_post_id,
    'status'  => 'approve',
    'order'   => 'ASC',
]);

// Dữ liệu mẫu dự phòng (Fallback) nếu chưa có bình luận trong CSDL
$lorem_default = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

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

<!-- Định kiểu CSS riêng cho Module 14 -->
<style>
    .module-14-wrapper {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        max-width: 1140px;
        margin: 20px auto;
    }

    /* Khung chứa bình luận */
    .module-14-container {
        background: #ffffff;
        border: 1px solid #dbe2ea;
        border-radius: 6px;
        padding: 25px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
        margin-bottom: 30px;
    }

    /* Tiêu đề phần bình luận */
    .module-14-header {
        border-bottom: 2px solid #005baa;
        padding-bottom: 12px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .module-14-title {
        font-size: 18px;
        font-weight: 700;
        color: #005baa;
        text-transform: uppercase;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Thẻ bình luận (Comment Card) theo mẫu Bootsnipp */
    .module-14-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        padding: 18px;
        margin-bottom: 18px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .module-14-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    /* Avatar người dùng xám có icon theo mẫu */
    .module-14-avatar {
        flex: 0 0 65px;
        width: 65px;
        height: 65px;
        background-color: #cbd5e1;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 32px;
        overflow: hidden;
    }

    .module-14-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Nội dung bình luận */
    .module-14-body {
        flex: 1;
    }

    .module-14-author {
        font-size: 17px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 8px 0;
        line-height: 1.3;
    }

    .module-14-text {
        font-size: 14px;
        color: #475569;
        line-height: 1.65;
        margin: 0;
    }

    /* Thanh tác vụ nhỏ dưới bình luận (Trả lời, Thời gian) */
    .module-14-meta {
        margin-top: 10px;
        font-size: 12.5px;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .module-14-reply-btn {
        color: #005baa;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }

    .module-14-reply-btn:hover {
        color: #d32f2f;
        text-decoration: underline;
    }

    /* BÌNH LUẬN CON (NESTED / REPLY - Jane Doe thụt lề) */
    .module-14-nested {
        margin-left: 65px;
        border-left: 3px solid #e2e8f0;
        padding-left: 15px;
    }

    .module-14-nested .module-14-avatar {
        flex: 0 0 55px;
        width: 55px;
        height: 55px;
        font-size: 26px;
    }

    /* Form gửi bình luận mới */
    .module-14-form-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 22px;
        margin-top: 35px;
    }

    .module-14-form-title {
        font-size: 16px;
        font-weight: 700;
        color: #005baa;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .module-14-form-group {
        margin-bottom: 14px;
    }

    .module-14-form-group label {
        font-size: 13.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 5px;
        display: block;
    }

    .module-14-form-control {
        width: 100%;
        padding: 9px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }

    .module-14-form-control:focus {
        border-color: #005baa;
        box-shadow: 0 0 0 3px rgba(0, 91, 170, 0.1);
    }

    .module-14-submit-btn {
        background-color: #005baa;
        color: #ffffff;
        border: none;
        padding: 10px 24px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .module-14-submit-btn:hover {
        background-color: #004580;
    }

    .module-14-cancel-reply {
        display: none;
        margin-left: 10px;
        color: #dc2626;
        font-size: 13px;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .module-14-card {
            flex-direction: column;
            gap: 12px;
        }

        .module-14-nested {
            margin-left: 20px;
            padding-left: 10px;
        }

        .module-14-avatar {
            width: 48px;
            height: 48px;
            font-size: 24px;
        }
    }
</style>

<div class="module-14-wrapper">
    <div class="module-14-container">
        <div class="module-14-header">
            <h3 class="module-14-title">
                <i class="fa-regular fa-comment-dots"></i> Bình luận
            </h3>
            <span class="badge badge-primary px-3 py-2" style="background:#005baa; border-radius:12px;">
                <?php 
                $count = !empty($comments_query) ? count($comments_query) : 3;
                echo esc_html($count) . ' bình luận'; 
                ?>
            </span>
        </div>

        <div class="module-14-list">
            <?php
            // Hàm đệ quy render từng bình luận
            function render_module_14_comment_item($author, $content, $date = '', $comment_id = 0, $is_nested = false) {
                ?>
                <div class="module-14-card <?php echo $is_nested ? 'is-nested' : ''; ?>" id="comment-<?php echo esc_attr($comment_id); ?>">
                    <!-- CỘT TRÁI: AVATAR XÁM CÓ ICON THEO MẪU -->
                    <div class="module-14-avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <!-- CỘT PHẢI: TÊN TÁC GIẢ & NỘI DUNG -->
                    <div class="module-14-body">
                        <h4 class="module-14-author"><?php echo esc_html($author); ?></h4>
                        <div class="module-14-text">
                            <p><?php echo nl2br(esc_html($content)); ?></p>
                        </div>
                        <div class="module-14-meta">
                            <?php if ($date) : ?>
                                <span><i class="fa-regular fa-clock"></i> <?php echo esc_html($date); ?></span>
                            <?php endif; ?>
                            <a href="#commentFormBox" class="module-14-reply-btn" onclick="prepareReply(<?php echo esc_attr($comment_id); ?>, '<?php echo esc_js($author); ?>')">
                                <i class="fa-solid fa-reply"></i> Trả lời
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }

            if (!empty($comments_query)) {
                // Nhóm các bình luận theo cha - con
                $parent_comments = [];
                $children_comments = [];

                foreach ($comments_query as $c) {
                    if ($c->comment_parent == 0) {
                        $parent_comments[] = $c;
                    } else {
                        $children_comments[$c->comment_parent][] = $c;
                    }
                }

                // Render bình luận cha và con
                foreach ($parent_comments as $parent) {
                    render_module_14_comment_item(
                        $parent->comment_author,
                        $parent->comment_content,
                        human_time_diff(strtotime($parent->comment_date), current_time('timestamp')) . ' trước',
                        $parent->comment_ID,
                        false
                    );

                    // Kiểm tra và render các bình luận con (Nested reply)
                    if (!empty($children_comments[$parent->comment_ID])) {
                        echo '<div class="module-14-nested">';
                        foreach ($children_comments[$parent->comment_ID] as $child) {
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
                // Hiển thị dữ liệu mẫu nếu chưa có dữ liệu thực tế
                foreach ($fallback_comments as $fb) {
                    render_module_14_comment_item($fb['author'], $fb['content'], $fb['date'], $fb['id'], false);

                    if (!empty($fb['children'])) {
                        echo '<div class="module-14-nested">';
                        foreach ($fb['children'] as $child) {
                            render_module_14_comment_item($child['author'], $child['content'], $child['date'], $child['id'], true);
                        }
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>

        <!-- FORM GỬI BÌNH LUẬN MỚI CHUẨN WORDPRESS -->
        <div class="module-14-form-box" id="commentFormBox">
            <h4 class="module-14-form-title">
                <i class="fa-solid fa-pen-to-square"></i> 
                <span id="replyFormTitle">Để lại bình luận của bạn</span>
                <a href="javascript:void(0)" class="module-14-cancel-reply" id="cancelReplyBtn" onclick="cancelReply()">
                    (Hủy trả lời)
                </a>
            </h4>

            <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post" id="commentform">
                <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr($current_post_id); ?>" id="comment_post_ID">
                <input type="hidden" name="comment_parent" id="comment_parent" value="0">

                <div class="row">
                    <div class="col-md-6 module-14-form-group">
                        <label for="author">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" name="author" id="author" class="module-14-form-control" placeholder="Ví dụ: John Doe" required>
                    </div>
                    <div class="col-md-6 module-14-form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="module-14-form-control" placeholder="email@example.com" required>
                    </div>
                </div>

                <div class="module-14-form-group">
                    <label for="comment">Nội dung bình luận <span class="text-danger">*</span></label>
                    <textarea name="comment" id="comment" rows="4" class="module-14-form-control" placeholder="Nhập nội dung bình luận..." required></textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" name="submit" id="submit" class="module-14-submit-btn">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Gửi bình luận
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT XỬ LÝ PHẢN HỒI (REPLY) TRỰC TIẾP -->
<script>
function prepareReply(commentId, authorName) {
    document.getElementById('comment_parent').value = commentId;
    document.getElementById('replyFormTitle').innerText = 'Đang trả lời: ' + authorName;
    document.getElementById('cancelReplyBtn').style.display = 'inline-block';
    
    // Cuộn mượt xuống form và focus vào ô textarea
    var formBox = document.getElementById('commentFormBox');
    formBox.scrollIntoView({ behavior: 'smooth' });
    document.getElementById('comment').focus();
}

function cancelReply() {
    document.getElementById('comment_parent').value = '0';
    document.getElementById('replyFormTitle').innerText = 'Để lại bình luận của bạn';
    document.getElementById('cancelReplyBtn').style.display = 'none';
}
</script>
