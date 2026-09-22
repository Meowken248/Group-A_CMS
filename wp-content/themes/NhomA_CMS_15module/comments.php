<?php

/**
 * =========================================================================
 * COMMENTS TEMPLATE - THEME ROOT
 * Đường dẫn: wp-content/themes/NhomA_CMS_15module/comments.php
 * Chức năng: Điều hướng toàn bộ chức năng bình luận sang Module 8
 * =========================================================================
 */

if (file_exists(get_template_directory() . '/Module 8/comments.php')) {
    include get_template_directory() . '/Module 8/comments.php';
} elseif (file_exists(get_template_directory() . '/Module 8/test.php')) {
    include get_template_directory() . '/Module 8/test.php';
}
