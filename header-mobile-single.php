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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <?php if (is_single()) : ?>
        <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/css/gxy-single-event.css' type='text/css' media='all' />
        <link rel='stylesheet' id='flexslider-style-css'  href="<?php echo get_template_directory_uri();?>/css/flexslider.css" type='text/css' media='all' />
    <?php endif;?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <?php if (ua_icalendar_app() && is_single()):?>
        <header id="masthead" class="site-header" role="banner">
            <div class="header-main">
                <div class="nav-back"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></div>
                <div class="nav-share"><span class="glyphicon glyphicon-share" aria-hidden="true"></span></div>
            </div>
        </header>
    <?php endif;?>
    <div id="main" class="site-main">


