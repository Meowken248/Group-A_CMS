<?php

/**
 * Archive Template - NhomA_CMS_15module
 * Hiển thị danh sách bài viết theo chuyên mục (category), tag, hoặc archive
 * Bố cục giống trang chủ: 3 cột (Module 11 | Danh sách bài | Module 12)
 */

get_header();
?>

<div class="row">
    <!-- CỘT 1: MODULE 11 - ARCHIVE / XEM NHIỀU -->
    <div class="col-lg-3 col-md-4 mb-4">
        <?php
        $module9_path = get_template_directory() . '/module9/module9.php';
        if (file_exists($module9_path)) {
            include $module9_path;
        }
        ?>
    </div>

    <!-- CỘT 2: DANH SÁCH BÀI VIẾT THEO CHUYÊN MỤC -->
    <div class="col-lg-6 col-md-4 mb-4">
        <div class="bg-white p-3 border rounded shadow-sm">
            <?php if (is_category()) : ?>
                <h4 class="mb-3 pb-2 border-bottom" style="color: #005baa; font-weight: 700;">
                    <i class="fa fa-folder-open mr-2"></i><?php single_cat_title(); ?>
                </h4>
                <?php if (category_description()) : ?>
                    <p class="text-muted mb-3"><?php echo category_description(); ?></p>
                <?php endif; ?>
            <?php elseif (is_tag()) : ?>
                <h4 class="mb-3 pb-2 border-bottom" style="color: #005baa; font-weight: 700;">
                    <i class="fa fa-tag mr-2"></i>Tag: <?php single_tag_title(); ?>
                </h4>
            <?php else : ?>
                <h4 class="mb-3 pb-2 border-bottom" style="color: #005baa; font-weight: 700;">
                    <i class="fa fa-archive mr-2"></i><?php the_archive_title(); ?>
                </h4>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="fit-posts-list">
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="fit-post-card" style="display:flex; align-items:stretch; background:#fff; border:1px solid #e2e8f0; border-radius:4px; padding:16px 20px; margin-bottom:15px; transition:all 0.25s;">
                            <!-- Date Badge -->
                            <div style="flex:0 0 80px; display:flex; flex-direction:column; align-items:center; justify-content:flex-start; padding-right:15px; margin-right:15px; border-right:1px solid #e2e8f0;">
                                <span style="font-size:30px; font-weight:700; color:#1e293b; line-height:1;"><?php echo get_the_date('d'); ?></span>
                                <span style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">THÁNG <?php echo get_the_date('m'); ?></span>
                            </div>
                            <!-- Content -->
                            <div style="flex:1; min-width:0;">
                                <h5 style="font-size:15px; font-weight:700; text-transform:uppercase; margin:0 0 8px;">
                                    <a href="<?php the_permalink(); ?>" style="color:#005baa; text-decoration:none;"><?php the_title(); ?></a>
                                </h5>
                                <p style="font-size:13.5px; color:#475569; line-height:1.6; margin:0;">
                                    <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                                </p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Phân trang -->
                <div class="text-center mt-3">
                    <?php the_posts_pagination(array(
                        'prev_text' => '&laquo; Trước',
                        'next_text' => 'Sau &raquo;',
                    )); ?>
                </div>
            <?php else : ?>
                <div class="text-center p-4" style="color:#64748b;">
                    <i class="fa fa-inbox fa-2x mb-2"></i>
                    <p>Chưa có bài viết nào trong chuyên mục này.</p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-sm btn-outline-primary">← Về trang chủ</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- CỘT 3: MODULE 10 - BÀI VIẾT MỚI -->
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
