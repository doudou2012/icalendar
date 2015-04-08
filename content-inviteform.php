<?php
/**
 * Created by PhpStorm.
 * File: content-inviteform.php
 * User: user
 * Date: 15/3/31
 * Time: 下午3:08
 */
date_default_timezone_set('Asia/Shanghai');
$pid = $_GET['pid'];
updateJoinUserList($pid);
$post=get_post($pid);
get_template_part('header','app');
?>
    <header id="masthead" class="site-header nav-fly-in" role="banner">
        <h1 class="nav-title">约人同往</h1>
        <div class="nav-back"><span class="previous-icon" aria-hidden="true"></span></div>
    </header>
    <div id="main" class="site-main nav-margin-top">
        <div class="container">
            <h1 class="page-title">邀请朋友</h1>
            <p>选择时间</p>
            <input id="datepicker" class="form-control" type="datetime-local" value="<?=date('Y-m-d\TH:i')?>" name="date"/>
            <input type="hidden" name="pid" id="p_id" value="<?=$pid?>" >
            <button class="btn btn-primary btn-block" id="send_invite">发给朋友</button>
            <button class="btn btn-link" id="cancel_invite">还是算了</button>
        </div>
    </div>
<?php get_template_part('footer','app');?>
