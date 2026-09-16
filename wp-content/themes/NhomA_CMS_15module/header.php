<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="site-container header-inner">
            <div class="site-logo">
                <h1><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
            </div>

            <!-- Khung tìm kiếm ở Header -->
            <div class="search-box-header">
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" name="s" placeholder="Tìm kiếm tin tức..." value="<?php echo get_search_query(); ?>" required>
                    <button type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </header>

    <main class="site-main">
        <div class="site-container">