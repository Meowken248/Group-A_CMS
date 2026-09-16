<?php
/**
 * Module 9: Categories Component
 * Thành viên thực hiện: Bùi Nguyễn Minh Quân
 * Lớp / Nhóm: Nhóm A CMS - Module 9
 * Mô tả: Thành phần giao diện hiển thị danh mục chuyên mục chuẩn theo đề bài
 */

// Tự động nạp stylesheet của Module 9
$module9_css_url = '';
if (function_exists('get_template_directory_uri')) {
    $module9_css_url = get_template_directory_uri() . '/module9/style.css';
} else {
    $module9_css_url = 'style.css';
}
?>

<!-- Nạp CSS riêng biệt của Module 9, không ảnh hưởng các module khác -->
<link rel="stylesheet" href="<?php echo esc_url($module9_css_url); ?>">

<div class="module-9-categories-widget">
    <div class="module-9-card">
        <!-- Tiêu đề Categories -->
        <h3 class="module-9-title">Categories</h3>

        <!-- Thanh sọc chéo trang trí (Striped Divider) -->
        <div class="module-9-divider-stripe" aria-hidden="true"></div>

        <!-- Danh sách chuyên mục -->
        <ul class="module-9-list">
            <?php
            $has_custom_cats = false;
            if (function_exists('get_categories')) {
                $categories = get_categories(array(
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                ));

                if (!empty($categories)) {
                    foreach ($categories as $cat) {
                        if ($cat->slug !== 'uncategorized' && $cat->slug !== 'chua-phan-loai') {
                            $has_custom_cats = true;
                            break;
                        }
                    }
                }
            }

            if ($has_custom_cats && !empty($categories)) :
                foreach ($categories as $cat) :
                    if ($cat->slug === 'uncategorized' || $cat->slug === 'chua-phan-loai') continue;
            ?>
                    <li class="module-9-item">
                        <span class="module-9-bullet"></span>
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="module-9-link">
                            <?php echo esc_html($cat->name); ?>
                        </a>
                    </li>
            <?php 
                endforeach;
            else : 
                // Danh sách hiển thị mẫu chính xác 100% theo hình ảnh đề bài của Module 9
            ?>
                <li class="module-9-item">
                    <span class="module-9-bullet"></span>
                    <a href="#" class="module-9-link">.Net Developer</a>
                </li>
                <li class="module-9-item">
                    <span class="module-9-bullet"></span>
                    <a href="#" class="module-9-link">Thực Tập Sinh Tester</a>
                </li>
                <li class="module-9-item">
                    <span class="module-9-bullet"></span>
                    <a href="#" class="module-9-link">Trợ giảng lập trình - Part time</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
