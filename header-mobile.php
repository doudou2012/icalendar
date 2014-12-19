<?php
/**
 * Created by PhpStorm.
 * User: fza
 * Date: 14/12/10
 * Time: 上午10:24
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,user-scalable=no">
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <link rel='stylesheet' id='twentyfourteen-style-css'  href='<?php echo get_template_directory_uri();?>/style-mobile.css' />
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
        <div class="header-main">
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <div class="search-toggle">
                <a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
            </div>
            <nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
                <button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
                <a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
            </nav>
        </div>
        <div id="search-container" class="search-box-wrapper hide">
            <div class="search-box">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>
    <div id="main" class="site-main">


