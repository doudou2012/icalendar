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
    <meta name="viewport" content="width=device-width">
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <link rel='stylesheet' id='twentyfourteen-style-css'  href='<?php echo get_template_directory_uri();?>/style-icalendar.css' />
    <?php if (is_single()) : ?>
        <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/css/gxy-cred-editor.css' type='text/css' media='all' />
    <?php endif;?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <div id="main" class="site-main">


