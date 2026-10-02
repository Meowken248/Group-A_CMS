<?php
/**
 * The main template file (Trang chủ / Danh sách bài viết)
 */

get_header();
?>

<main class="site-main">
    <div class="site-container">
        <h2 class="page-header-title">Bài viết mới nhất</h2>

        <?php if ( have_posts() ) : ?>
            <div class="posts-grid">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-card-thumb' ) ); ?>
                            </a>
                        <?php endif; ?>

                        <div class="post-card-body">
                            <h3 class="post-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="post-card-meta">
                                <span><?php echo get_the_date(); ?></span> &bull; 
                                <span><?php the_category( ', ' ); ?></span>
                            </div>
                            <div class="post-card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-links" style="margin-top: 30px; text-align: center;">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p>Không có bài viết nào.</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
