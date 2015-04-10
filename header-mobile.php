<?php
/**
 * Created by PhpStorm.
 * User: fza
 * Date: 14/12/10
 * Time: 上午10:24
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <link rel='stylesheet' id='twentyfourteen-style-css'  href='<?php echo get_template_directory_uri();?>/style-mobile.css' />
    <?php if (ua_icalendar_app()):?>
        <link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/css/alertify.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/css/alert-style.css" rel="stylesheet" />
        <link rel='stylesheet' id='slider-style-css'  href="<?php echo get_template_directory_uri();?>/css/jquery.excoloSlider.css" type='text/css' media='all' />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/icalendar-app.css" rel="stylesheet" />
    <?php endif;?>
    <script type="text/javascript">
            var home_url = "<?=home_url()?>";
    </script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <?php if (ua_icalendar_app() && !isset($_GET['invite'])):?>
    <header id="masthead" class="site-header nav-fly-in" role="banner">
        <h1 class="nav-title">展览日历</h1>
        <?php if (is_home() && !(isset($_GET['city-list']) || isset($_GET['art-list']))) :?>
            <div class="nav-city"><span class="bullet_list" aria-hidden="true"></span></div>
            <div class="nav-user"><span class="user-icon" aria-hidden="true"></span></div>
        <?php else:?>
            <div class="nav-back"><span class="previous-icon" aria-hidden="true"></span></div>
        <?php endif;?>
    </header>
        <?php //echo get_slider_img();?>
    <?php else:?>
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
    <?php endif;?>
    <div id="main" class="site-main<?php if (ua_icalendar_app()) echo ' nav-margin-top'; ?>">


