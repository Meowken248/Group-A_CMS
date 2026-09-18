<?php
/**
 * Single Post Template - NhomA_CMS_15module
 * Hiển thị bài viết chi tiết và tích hợp Module 14 Comments
 */

get_header();
?>

<div class="row">
    <div class="col-lg-12">
        <?php while (have_posts()) : the_post(); ?>
            <article class="card p-4 mb-4 border-0 shadow-sm">
                <h1 class="font-weight-bold text-dark mb-3"><?php the_title(); ?></h1>
                
                <div class="text-secondary mb-4 pb-3 border-bottom small">
                    <span class="mr-3"><i class="fa-regular fa-calendar mr-1"></i> <?php echo get_the_date(); ?></span>
                    <span class="mr-3"><i class="fa-regular fa-user mr-1"></i> <?php the_author(); ?></span>
                    <span><i class="fa-regular fa-comment mr-1"></i> <?php comments_number('0 bình luận', '1 bình luận', '% bình luận'); ?></span>
                </div>

                <div class="post-content mb-4" style="line-height: 1.8; font-size: 15px;">
                    <?php the_content(); ?>
                </div>
            </article>

            <!-- KHU VỰC BÌNH LUẬN (MODULE 14) -->
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        <?php endwhile; ?>
    </div>
</div>

<?php
get_footer();
