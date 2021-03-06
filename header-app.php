<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/css/alertify.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/css/alert-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/icalendar-app.css" rel="stylesheet" />
    <link rel='stylesheet' id='slider-style-css'  href="<?php echo get_template_directory_uri();?>/css/gxy-single-event.css" type='text/css' media='all' />
    <link rel='stylesheet' id='slider-style-css'  href="<?php echo get_template_directory_uri();?>/css/jquery.excoloSlider.css" type='text/css' media='all' />
    <script type="text/javascript">
        var home_url = "<?=home_url()?>";
    </script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <div id="main" class="site-main<?php if (ua_icalendar_app()) echo ' nav-margin-top'; ?>">