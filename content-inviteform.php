<?php
/**
 * Created by PhpStorm.
 * File: content-inviteform.php
 * User: user
 * Date: 15/3/31
 * Time: 下午3:08
 */
$pid = $_GET['pid'];
updateJoinUserList($pid);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link rel='stylesheet' id='genericons-css'  href='<?php echo get_template_directory_uri();?>/genericons/genericons.css' type='text/css' media='all' />
    <link rel='stylesheet' id='twentyfourteen-style-css'  href='<?php echo get_template_directory_uri();?>/style-mobile.css' />
    <link href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/css/themes/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/icalendar-app.css" rel="stylesheet" />
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header id="masthead" class="site-header nav-fly-in" role="banner">
        <h1 class="nav-title">展览日历</h1>
        <div class="nav-back"><span class="previous-icon" aria-hidden="true"></span></div>
    </header>
    <div id="main" class="site-main nav-margin-top">
        <div class="container">
            <h1>邀请朋友</h1>
            <p>选择时间</p>
            <input class="form-control" type="datetime-local" name="date"/>
            <input type="hidden" name="pid" id="p_id" value="<?=$pid?>" >
            <button class="btn btn-primary btn-block" id="send_invite">写好了，发出去</button>
            <button class="btn btn-link " id="cancel_invite">还是算了</button>
        </div>
    </div>
</div>
<script type='text/javascript' src='http://libs.baidu.com/jquery/2.0.0/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/functions.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/webridge.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/icalendar.js'></script>
</body>
</html>
<?php my_get_footer();?>