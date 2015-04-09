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
        <h1 class="nav-title">邀请朋友看展</h1>
        <div class="nav-back"><span class="previous-icon" aria-hidden="true"></span></div>
    </header>
    <div id="main" class="site-main nav-margin-top">
        <div class="container">
            <div class="invite-form-card">
                <h3>何时出发？</h3>
                <input id="datepicker" class="date-picker" type="datetime-local" value="<?=date('Y-m-d\TH:i')?>" name="date"/>
                <input type="hidden" name="pid" id="p_id" value="<?=$pid?>" >
                <input type="hidden" name="title" id="post_title" value="<?=$post->post_title?>" >
                <button class="btn btn-lg btn-not-rounded color-red" id="send_invite">发给朋友</button>
                <button class="btn btn-link" id="cancel_invite">取消</button>
            </div>
        </div>
    </div>
<?php get_template_part('footer','app');?>
