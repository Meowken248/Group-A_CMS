<?php
/**
 * Module 10: Recent Posts Component
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 10
 * Mô tả: Khối hiển thị Bài viết mới nhất (Recent post) chuẩn theo đề bài
 */

// Tự động nạp stylesheet riêng của Module 10
$module10_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module10_css_url = get_template_directory_uri() . '/module10/style.css';
} else {
    $module10_css_url = 'style.css';
}

// Link trang tất cả tin tức
$all_posts_url = '#';
if (function_exists('get_permalink') && function_exists('get_option')) {
    $posts_page_id = get_option('page_for_posts');
    if ($posts_page_id) {
        $all_posts_url = get_permalink($posts_page_id);
    } elseif (function_exists('home_url')) {
        $all_posts_url = home_url('/');
    }
}
?>

<!-- Nạp CSS riêng của Module 10 -->
<link rel="stylesheet" href="<?php echo esc_url($module10_css_url); ?>">

<div class="module-10-recent-posts-widget">
    <div class="module-10-card">
        <!-- Danh sách bài viết mới nhất -->
        <ul class="module-10-posts-list">
            <?php
            $has_wp_posts = false;
            $recent_query = null;

            if (class_exists('WP_Query')) {
                $recent_query = new WP_Query(array(
                    'post_type'           => 'post',
                    'post_status'         => 'publish',
                    'posts_per_page'      => 3,
                    'ignore_sticky_posts' => true,
                ));

                // Nếu có ít nhất 2 bài viết thực tế trong WordPress
                if ($recent_query->have_posts() && $recent_query->found_posts >= 2) {
                    $has_wp_posts = true;
                }
            }

            if ($has_wp_posts && $recent_query && $recent_query->have_posts()) :
                while ($recent_query->have_posts()) : $recent_query->the_post();
                    $day   = get_the_date('d');
                    $month = get_the_date('m');
                    $year  = get_the_date('y'); // Định dạng 2 chữ số như '23
            ?>
                    <li class="module-10-post-item">
                        <!-- Badge ngày tháng dạng phân số -->
                        <div class="module-10-date">
                            <span class="module-10-day"><?php echo esc_html($day); ?></span>
                            <div class="module-10-divider">
                                <span class="module-10-line"></span>
                                <span class="module-10-year"><?php echo esc_html($year); ?></span>
                            </div>
                            <span class="module-10-month"><?php echo esc_html($month); ?></span>
                        </div>

                        <!-- Tiêu đề bài viết -->
                        <div class="module-10-content">
                            <a href="<?php the_permalink(); ?>" class="module-10-title">
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </li>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Dữ liệu mẫu chuẩn 100% theo hình ảnh đề bài của Module 10
                $sample_posts = array(
                    array(
                        'day'   => '13',
                        'month' => '08',
                        'year'  => '23',
                        'title' => 'Sinh viên vượt khó, đạt thành tích nổi bật',
                    ),
                    array(
                        'day'   => '13',
                        'month' => '08',
                        'year'  => '23',
                        'title' => 'Livestream với chủ đề: Thiết kế đồ họa - Phác họa tương lai',
                    ),
                    array(
                        'day'   => '07',
                        'month' => '08',
                        'year'  => '23',
                        'title' => 'Livestream với chủ đề: Làm chủ công nghệ cùng Gen Z',
                    ),
                );

                foreach ($sample_posts as $post_item) :
            ?>
                    <li class="module-10-post-item">
                        <!-- Badge ngày tháng dạng phân số -->
                        <div class="module-10-date">
                            <span class="module-10-day"><?php echo esc_html($post_item['day']); ?></span>
                            <div class="module-10-divider">
                                <span class="module-10-line"></span>
                                <span class="module-10-year"><?php echo esc_html($post_item['year']); ?></span>
                            </div>
                            <span class="module-10-month"><?php echo esc_html($post_item['month']); ?></span>
                        </div>

                        <!-- Tiêu đề bài viết -->
                        <div class="module-10-content">
                            <a href="#" class="module-10-title">
                                <?php echo esc_html($post_item['title']); ?>
                            </a>
                        </div>
                    </li>
            <?php
                endforeach;
            endif;
            ?>
        </ul>

        <!-- Nút Xem tất cả tin tức ở chân card -->
        <div class="module-10-footer">
            <a href="<?php echo esc_url($all_posts_url); ?>" class="module-10-btn-all">
                XEM TẤT CẢ TIN TỨC
            </a>
        </div>
    </div>
</div>
