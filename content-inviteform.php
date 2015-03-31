<?php
/**
 * Created by PhpStorm.
 * File: content-inviteform.php
 * User: user
 * Date: 15/3/31
 * Time: 下午3:08
 */
my_get_header();
$pid = get_query_var('p');
updateJoinUserList($pid);
?>
<div class="container">
    <h1>邀请朋友</h1>
    <p>选择时间</p>
    <input class="form-control" type="datetime-local" name="date"/>
    <input type="hidden" name="pid" id="p_id" value="<?=$pid?>" >
    <button class="btn btn-primary btn-block" id="send_invite">写好了，发出去</button>
    <button class="btn btn-link " id="cancel_invite">还是算了</button>
</div>
<?php my_get_footer();?>