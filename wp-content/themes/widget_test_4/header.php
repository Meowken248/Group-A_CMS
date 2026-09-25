<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="site-container">
        <div class="site-branding">
            <div>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            </div>
            <nav class="site-navigation">
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/wp-admin/' ) ); ?>">Quản trị</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>
