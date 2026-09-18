<?php
/**
 * Single Post Template - NhomA_CMS_15module
 * Bố cục Trang Chi Tiết chuẩn theo thiết kế Hình 3:
 * - Cột 1 (Trái): Categories (Module 9)
 * - Cột 2 (Giữa): Detail (Module 6) - Nội dung chi tiết bài viết
 * - Cột 3 (Phải): Recent post (Module 10) - Bài viết mới nhất
 * - Phía dưới: Prev - Next Post (Module 7) & Comments (Module 8)
 */

get_header();
?>

<div class="row">
    <!-- CỘT 1 (TRÁI): CATEGORIES (MODULE 9) -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module9_path = get_template_directory() . '/module9/module9.php';
        if (file_exists($module9_path)) {
            include $module9_path;
        }
        ?>
    </div>

    <!-- CỘT 2 (GIỮA): DETAIL (MODULE 6) - NỘI DUNG CHI TIẾT BÀI VIẾT -->
    <div class="col-lg-6 col-md-4 mb-4">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <!-- MODULE 6: DETAIL BÀI VIẾT -->
                <article class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px;">
                    <h1 class="font-weight-bold text-dark mb-3" style="font-size: 22px; line-height: 1.4;">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="text-secondary mb-4 pb-3 border-bottom small d-flex flex-wrap align-items-center">
                        <span class="mr-3"><i class="fa-regular fa-calendar mr-1"></i> <?php echo get_the_date(); ?></span>
                        <span class="mr-3"><i class="fa-regular fa-user mr-1"></i> <?php the_author(); ?></span>
                        <span><i class="fa-regular fa-comment mr-1"></i> <?php comments_number('0 bình luận', '1 bình luận', '% bình luận'); ?></span>
                    </div>

                    <div class="post-content mb-4" style="line-height: 1.8; font-size: 15px; color: #334155;">
                        <?php the_content(); ?>
                    </div>
                </article>

                <!-- MODULE 7: PREV - NEXT POST (ĐIỀU HƯỚNG BÀI TRƯỚC / SAU) -->
                <div class="card p-3 mb-4 border-0 shadow-sm" style="border-radius: 6px; background-color: #f8fafc;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap" style="font-size: 13.5px; font-weight: 600;">
                        <div class="prev-post-link my-1">
                            <?php previous_post_link('&laquo; %link', 'Bài trước: %title'); ?>
                        </div>
                        <div class="next-post-link my-1">
                            <?php next_post_link('%link &raquo;', 'Bài sau: %title'); ?>
                        </div>
                    </div>
                </div>

                <!-- MODULE 8 / MODULE 14: COMMENTS (KHU VỰC BÌNH LUẬN) -->
                <div class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px;">
                    <?php
                    if (comments_open() || get_comments_number()) {
                        comments_template();
                    }
                    ?>
                </div>
        <?php
            endwhile;
        else :
            // Nội dung mẫu khi chưa có bài viết thực tế trong WordPress
        ?>
            <!-- MODULE 6 (MẪU): DETAIL BÀI VIẾT -->
            <article class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px;">
                <h1 class="font-weight-bold text-dark mb-3" style="font-size: 22px; line-height: 1.4;">
                    Sinh viên vượt khó, đạt thành tích nổi bật tại Hội thi Tin học
                </h1>
                
                <div class="text-secondary mb-4 pb-3 border-bottom small d-flex flex-wrap align-items-center">
                    <span class="mr-3"><i class="fa-regular fa-calendar mr-1"></i> 13/08/2023</span>
                    <span class="mr-3"><i class="fa-regular fa-user mr-1"></i> Khoa CNTT - FIT TDC</span>
                    <span><i class="fa-regular fa-comment mr-1"></i> 3 bình luận</span>
                </div>

                <div class="post-content mb-4" style="line-height: 1.8; font-size: 15px; color: #334155;">
                    <p>Khoa Công nghệ Thông tin - Trường Cao đẳng Công nghệ Thủ Đức (TDC) vừa tuyên dương các bạn sinh viên đạt giải cao trong kỳ thi Olympic Tin học sinh viên và Hội thi tay nghề trẻ vừa qua.</p>
                    <p>Với tinh thần nhiệt huyết, sáng tạo và sự dẫn dắt tận tâm của đội ngũ giảng viên, các bạn đã xuất sắc mang về nhiều giải thưởng danh giá, khẳng định năng lực chuyên môn và vị thế đào tạo công nghệ hàng đầu của FIT TDC.</p>
                </div>
            </article>

            <!-- MODULE 7 (MẪU): PREV - NEXT POST -->
            <div class="card p-3 mb-4 border-0 shadow-sm" style="border-radius: 6px; background-color: #f8fafc;">
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="font-size: 13.5px; font-weight: 600;">
                    <div class="prev-post-link my-1">
                        <a href="#" class="text-primary">&laquo; Bài trước: Khai giảng lớp Chuyên đề AI & Cloud</a>
                    </div>
                    <div class="next-post-link my-1">
                        <a href="#" class="text-primary">Livestream Thiết kế đồ họa &raquo;</a>
                    </div>
                </div>
            </div>

            <!-- MODULE 8 (MẪU): COMMENTS -->
            <div class="card p-4 mb-4 border-0 shadow-sm" style="border-radius: 6px;">
                <h5 class="font-weight-bold mb-3">Bình luận (Comments - Module 8)</h5>
                <p class="text-muted small">Hãy chia sẻ cảm nghĩ của bạn về bài viết này...</p>
                <form>
                    <div class="form-group mb-3">
                        <textarea class="form-control" rows="3" placeholder="Viết bình luận của bạn tại đây..."></textarea>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm px-3 font-weight-bold">Gửi bình luận</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- CỘT 3 (PHẢI): RECENT POST (MODULE 10) -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module10_path = get_template_directory() . '/module10/module10.php';
        if (file_exists($module10_path)) {
            include $module10_path;
        }
        ?>
    </div>
</div>

<?php
get_footer();
