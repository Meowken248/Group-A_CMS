<?php

/**
 * =========================================================================
 * MODULE 8: COMMENTS (BÌNH LUẬN)
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Module 8/comments.php
 * Thiết kế giao diện: Chuẩn mẫu Bootsnipp rNEdR (Make a Post card with share button)
 * Trường hợp: Tối ưu cho người dùng đã login và hỗ trợ khách vãng lai
 * =========================================================================
 */

// Ngăn truy cập trái phép nếu bài viết yêu cầu mật khẩu
if (post_password_required()) {
    return;
}
?>

<style>
    /* ===================================================
       CSS MODULE 8: GIAO DIỆN BÌNH LUẬN CHUẨN BOOTSNIPP rNEdR
       =================================================== */
    .fit-comments-area {
        margin-top: 35px;
        padding-top: 25px;
        border-top: 1px solid #e2e8f0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    /* TIÊU ĐỀ KHỐI BÌNH LUẬN */
    .fit-comments-title {
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .fit-comments-title .badge-count {
        background-color: #007bff;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
    }

    /* CARD MAKE A POST (BOOTSNIPP rNEdR) */
    .fit-comment-card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        margin-bottom: 30px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .fit-comment-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        padding: 10px 16px 0;
    }

    .fit-comment-card .card-header-tabs {
        margin: 0 0 -1px 0;
        padding: 0;
        list-style: none;
        display: flex;
        border-bottom: none;
    }

    .fit-comment-card .card-header-tabs .nav-item {
        margin: 0;
        list-style: none;
    }

    .fit-comment-card .card-header-tabs .nav-link {
        display: inline-block;
        font-size: 15px;
        font-weight: 500;
        color: #495057;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-bottom-color: #ffffff;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        padding: 8px 18px;
        line-height: 1.5;
        text-decoration: none;
        cursor: default;
    }

    .fit-comment-card .card-body {
        padding: 20px;
    }

    .fit-comment-card .form-group {
        margin-bottom: 15px;
    }

    .fit-comment-card .sr-only {
        position: absolute !important;
        width: 1px !important;
        height: 1px !important;
        padding: 0 !important;
        margin: -1px !important;
        overflow: hidden !important;
        clip: rect(0, 0, 0, 0) !important;
        white-space: nowrap !important;
        border: 0 !important;
    }

    .fit-comment-textarea {
        width: 100%;
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 12px 16px;
        font-size: 15px;
        color: #495057;
        resize: vertical;
        min-height: 90px;
        box-sizing: border-box;
        font-family: inherit;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .fit-comment-textarea:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .fit-comment-textarea::placeholder {
        color: #6c757d;
        font-size: 15px;
    }

    /* NÚT SHARE (BOOTSNIPP rNEdR) */
    .fit-comment-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 15px;
    }

    .fit-comment-btn-share {
        background-color: #007bff;
        border: 1px solid #007bff;
        color: #ffffff;
        padding: 7px 24px;
        font-size: 14.5px;
        line-height: 1.5;
        border-radius: 4px;
        font-weight: 400;
        text-transform: lowercase;
        cursor: pointer;
        display: inline-block;
        text-align: center;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }

    .fit-comment-btn-share:hover {
        background-color: #0069d9;
        border-color: #0062cc;
        color: #ffffff;
    }

    /* DANH SÁCH BÌNH LUẬN ĐÃ CÓ (CARD ITEM THEO STYLE rNEdR) */
    .fit-comment-list {
        margin-bottom: 25px;
    }

    .fit-comment-item {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    }

    .fit-comment-item .fit-comment-inner {
        padding: 1rem;
    }

    .fit-comment-header-row {
        display: flex;
        align-items: center;
        margin-bottom: 0.65rem;
    }

    .fit-comment-avatar {
        margin-right: 12px;
        flex-shrink: 0;
    }

    .fit-comment-avatar img {
        border-radius: 50%;
        width: 44px;
        height: 44px;
        object-fit: cover;
        display: block;
    }

    .fit-comment-meta {
        flex: 1;
        min-width: 0;
    }

    .fit-comment-author {
        font-size: 15px;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        line-height: 1.3;
    }

    .fit-comment-time {
        font-size: 12px;
        color: #6c757d;
        margin: 2px 0 0;
    }

    .fit-comment-content {
        font-size: 14px;
        color: #4a5568;
        line-height: 1.6;
        padding-left: 56px;
    }

    .fit-comment-content p {
        margin-bottom: 0.5rem;
    }

    .fit-comment-content p:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 576px) {
        .fit-comment-content {
            padding-left: 0;
            margin-top: 10px;
        }
    }
</style>

<div class="fit-comments-area" id="comments">
    <!-- TIÊU ĐỀ SỐ LƯỢNG BÌNH LUẬN (NẾU CÓ) -->
    <?php $comments_count = get_comments_number(); ?>
    <?php if ($comments_count > 0) : ?>
        <h3 class="fit-comments-title">
            <span>Bình luận</span>
            <span class="badge-count"><?php echo esc_html($comments_count); ?></span>
        </h3>

        <!-- DANH SÁCH BÌNH LUẬN THEO CARD STYLE BOOTSNIPP rNEdR -->
        <div class="fit-comment-list">
            <?php
            $comments = get_comments(array(
                'post_id' => get_the_ID(),
                'status'  => 'approve',
                'order'   => 'ASC',
            ));

            foreach ($comments as $comment) :
            ?>
                <article class="fit-comment-item" id="comment-<?php comment_ID(); ?>">
                    <div class="fit-comment-inner">
                        <div class="fit-comment-header-row">
                            <div class="fit-comment-avatar">
                                <?php echo get_avatar($comment, 44, '', esc_attr($comment->comment_author)); ?>
                            </div>
                            <div class="fit-comment-meta">
                                <h4 class="fit-comment-author"><?php echo esc_html($comment->comment_author); ?></h4>
                                <p class="fit-comment-time">
                                    <?php echo human_time_diff(get_comment_time('U', true, $comment), current_time('timestamp')) . ' trước'; ?>
                                    (<?php echo get_comment_date('d/m/Y H:i', $comment); ?>)
                                </p>
                            </div>
                        </div>
                        <div class="fit-comment-content">
                            <?php comment_text(); ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- FORM ĐĂNG BÌNH LUẬN (MAKE A POST - BOOTSNIPP rNEdR) -->
    <?php if (comments_open()) : ?>
        <form action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>" method="post" id="commentform" class="fit-comment-form">
            <section class="card fit-comment-card">
                <!-- Header Tab: Make a Post -->
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <span class="nav-link active">Make a Post</span>
                        </li>
                    </ul>
                </div>

                <!-- Card Body: Textarea và Submit Button -->
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label class="sr-only" for="comment">post</label>
                        <textarea class="form-control fit-comment-textarea" id="comment" name="comment" rows="3" placeholder="What are you thinking..." required></textarea>
                    </div>

                    <?php if (!is_user_logged_in()) : ?>
                        <!-- Các trường thông tin bổ sung khi người dùng chưa đăng nhập -->
                        <div class="row mb-3" style="display: flex; gap: 15px; margin-bottom: 15px;">
                            <div style="flex: 1;">
                                <input type="text" class="form-control" name="author" placeholder="Họ và tên *" required style="width: 100%; border: 1px solid #ced4da; border-radius: 4px; padding: 10px 14px; box-sizing: border-box;">
                            </div>
                            <div style="flex: 1;">
                                <input type="email" class="form-control" name="email" placeholder="Email *" required style="width: 100%; border: 1px solid #ced4da; border-radius: 4px; padding: 10px 14px; box-sizing: border-box;">
                            </div>
                        </div>

                        <div class="fit-comment-actions" style="justify-content: space-between;">
                            <small class="text-muted" style="color: #6c757d; font-size: 13px;">
                                <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" style="color: #007bff; text-decoration: none;">Đăng nhập</a> để bình luận với tài khoản của bạn.
                            </small>
                            <button type="submit" name="submit" id="submit" class="fit-comment-btn-share">share</button>
                        </div>
                    <?php else : ?>
                        <!-- Giao diện chuẩn xác 100% theo ảnh mẫu rNEdR khi đã đăng nhập -->
                        <div class="fit-comment-actions">
                            <button type="submit" name="submit" id="submit" class="fit-comment-btn-share">share</button>
                        </div>
                    <?php endif; ?>

                    <!-- Hidden fields chuẩn của WordPress Comment Form -->
                    <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID" />
                    <input type="hidden" name="comment_parent" id="comment_parent" value="0" />
                </div>
            </section>
        </form>
    <?php else : ?>
        <p class="text-muted text-center my-3"><em>Bình luận đã đóng cho bài viết này.</em></p>
    <?php endif; ?>
</div>
