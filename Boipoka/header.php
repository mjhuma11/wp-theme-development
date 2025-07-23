<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?= is_home() ? "HOME" : get_the_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Header Area -->
    <header id="header_area" class="<?php echo get_theme_mod('j_menu_position', 'right_menu'); ?>">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_theme_mod('j_logo', get_template_directory_uri() . '/images/f-logo.png'); ?>" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="logo-img">
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php 
                    wp_nav_menu(array(
                        'theme_location' => 'main_menu',
                        'container' => false,
                        'menu_class' => 'navbar-nav ms-auto',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'walker' => new Bootstrap_Nav_Walker(),
                    )); 
                    ?>
                </div>
            </nav>
        </div>
    </header>