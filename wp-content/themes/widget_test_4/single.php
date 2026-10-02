<?php
/**
 * The single post template file (Trang chi tiết bài viết)
 */

get_header();
?>

<main class="site-main">
    <div class="site-container">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>
                <h1 class="single-post-title"><?php the_title(); ?></h1>
                
                <div class="single-post-meta">
                    <span>Đăng ngày: <?php echo get_the_date(); ?></span> &bull; 
                    <span>Tác giả: <?php the_author(); ?></span> &bull; 
                    <span>Chuyên mục: <?php the_category( ', ' ); ?></span>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-post-thumbnail-wrapper">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'single-post-thumb' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="single-post-content">
                    <?php the_content(); ?>
                </div>

                <div class="single-post-tags" style="margin-top: 25px; padding-top: 15px; border-top: 1px dashed #e2e8f0;">
                    <?php the_tags( '<span style="font-weight: 600;">Tags: </span>', ', ', '' ); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
