<?php

/**
 * ==========================================================
 * MODULE 3: FOOTER
 * Dự án: Group-A CMS (15 Modules) - Khoa CNTT FIT-TDC
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/Moudle3/test.php
 * Thiết kế chuẩn Bootsnipp rlXdE (Footer with social icons & links)
 * Dữ liệu động từ Database: Comment, Categories, Last Posts
 * ==========================================================
 */
?>

<!-- Định kiểu CSS riêng cho Module 3: Footer (Bootsnipp rlXdE) -->
<style>
    #footer {
        background: #006341 !important;
        color: #ffffff;
        padding-top: 55px;
        padding-bottom: 25px;
        margin-top: 50px;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    #footer h5 {
        padding-left: 10px;
        border-left: 3px solid #eeeeee;
        padding-bottom: 6px;
        margin-bottom: 20px;
        color: #ffffff;
        font-size: 17px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #footer a {
        color: #ffffff;
        text-decoration: none !important;
        background-color: transparent;
        transition: all 0.25s ease;
    }

    #footer ul.quick-links {
        padding-left: 0;
        list-style: none;
        margin-bottom: 20px;
    }

    #footer ul.quick-links li {
        padding: 5px 0;
        transition: all 0.25s ease-in-out;
        font-size: 14px;
        line-height: 1.5;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    #footer ul.quick-links li:hover {
        padding-left: 6px;
        font-weight: 600;
    }

    #footer ul.quick-links li a {
        color: #ffffff;
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    #footer ul.quick-links li a:hover {
        color: #e2e8f0;
    }

    #footer ul.quick-links li a i {
        margin-right: 6px;
        font-size: 12px;
        opacity: 0.85;
    }

    /* Social icons */
    #footer ul.social {
        padding-left: 0;
        list-style: none;
        margin: 15px 0 10px 0;
        text-align: center;
    }

    #footer ul.social li {
        display: inline-block;
        margin: 0 10px;
    }

    #footer ul.social li a i {
        font-size: 22px;
        color: #ffffff;
        transition: all 0.3s ease;
        display: inline-block;
    }

    #footer ul.social li:hover a i {
        transform: translateY(-3px) scale(1.15);
        color: #e2e8f0;
    }

    #footer hr {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin: 20px auto;
        width: 100%;
    }

    #footer .footer-bottom-text {
        text-align: center;
        color: #ffffff;
        font-size: 13px;
        line-height: 1.6;
    }

    #footer .footer-bottom-text p {
        margin-bottom: 6px;
    }

    #footer .footer-bottom-text a {
        color: #ffffff;
        text-decoration: underline !important;
    }

    #footer .footer-bottom-text a:hover {
        color: #cbd5e1;
    }

    #footer .footer-copyright {
        font-size: 13px;
        margin-top: 5px;
        opacity: 0.95;
    }

    @media (max-width: 767.98px) {
        #footer {
            text-align: center;
        }

        #footer h5 {
            border-left: none;
            border-bottom: 2px solid #eeeeee;
            display: inline-block;
            padding-left: 0;
            padding-bottom: 4px;
            margin-top: 15px;
        }

        #footer ul.quick-links li:hover {
            padding-left: 0;
        }
    }
</style>

<section id="footer">
    <div class="container">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <!-- CỘT 1: BÌNH LUẬN MỚI (COMMENTS) -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Bình luận mới</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $recent_comments = get_comments(array(
                        'number'      => 5,
                        'status'      => 'approve',
                        'post_status' => 'publish',
                    ));

                    if (!empty($recent_comments)) :
                        foreach ($recent_comments as $comment) :
                            $author = get_comment_author($comment);
                            $comment_text = wp_trim_words($comment->comment_content, 6, '...');
                            $comment_url = get_comment_link($comment);
                    ?>
                            <li>
                                <a href="<?php echo esc_url($comment_url); ?>" title="<?php echo esc_attr($author . ': ' . $comment->comment_content); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo esc_html($author); ?>: <?php echo esc_html($comment_text); ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i> Chưa có bình luận nào</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- CỘT 2: CHUYÊN MỤC (CATEGORIES) -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Chuyên mục</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $categories = get_categories(array(
                        'orderby'    => 'name',
                        'order'      => 'ASC',
                        'hide_empty' => 0,
                        'number'     => 5,
                    ));

                    if (!empty($categories)) :
                        foreach ($categories as $cat) :
                            $cat_url = get_category_link($cat->term_id);
                    ?>
                            <li>
                                <a href="<?php echo esc_url($cat_url); ?>" title="<?php echo esc_attr($cat->name); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo esc_html($cat->name); ?> (<?php echo esc_html($cat->count); ?>)
                                </a>
                            </li>
                        <?php
                        endforeach;
                    else :
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i> Chưa có chuyên mục</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- CỘT 3: BÀI VIẾT MỚI (LAST POSTS) -->
            <div class="col-xs-12 col-sm-4 col-md-4">
                <h5>Bài viết mới</h5>
                <ul class="list-unstyled quick-links">
                    <?php
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ));

                    if (!empty($recent_posts)) :
                        foreach ($recent_posts as $post_item) :
                            $post_url = get_permalink($post_item['ID']);
                            $post_title = $post_item['post_title'];
                    ?>
                            <li>
                                <a href="<?php echo esc_url($post_url); ?>" title="<?php echo esc_attr($post_title); ?>">
                                    <i class="fa fa-angle-double-right"></i> <?php echo esc_html(wp_trim_words($post_title, 6, '...')); ?>
                                </a>
                            </li>
                        <?php
                        endforeach;
                        wp_reset_query();
                    else :
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-angle-double-right"></i> Chưa có bài viết nào</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <!-- DÒNG CÁC ICON MẠNG XÃ HỘI (SOCIAL) -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <ul class="list-unstyled social">
                    <li><a href="https://facebook.com" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://twitter.com" target="_blank" title="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="https://instagram.com" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://plus.google.com" target="_blank" title="Google Plus"><i class="fa-brands fa-google-plus-g"></i></a></li>
                    <li><a href="mailto:contact@fit.tdc.edu.vn" title="Email"><i class="fa-solid fa-envelope"></i></a></li>
                </ul>
            </div>
            <div class="col-12">
                <hr>
            </div>
        </div>

        <!-- THÔNG TIN BẢN QUYỀN VÀ MÔ TẢ (BOOTSNIPP RLXDE) -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 footer-bottom-text">
                <p><u><a href="#">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                <p class="footer-copyright">&copy; All right Reversed. <a href="https://sunlimetech.com" target="_blank">Sunlimetech</a></p>
            </div>
        </div>
    </div>
</section>
