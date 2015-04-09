<?php
/**
*
* The default template for displaying content-show
*
* Used for both single and index/archive/search.
*
* @package WordPress
* @subpackage Twenty_Fourteen
* @since Twenty Fourteen 1.0
*/
//$categories = get_terms(array('name'=>'city'));
$pid = $_GET['pid'];
$date = date('Y-m-d H:s',strtotime(urldecode($_REQUEST['date'])));
$post = get_post($pid);
$joins = get_join_user($pid);
$current_user = wp_get_current_user();
get_template_part('header','app');
?>
<article id="post-<?=$post->ID?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title" style="font-weight: 300;">
        <?php echo '我想去看在「'.types_render_field('place','').'」举办的「'.$post->post_title.'」展览，你想一起来吗？'; ?>
        </h1>
        <div class="all-sorts-of-meta">
            <p><span class="time-span"><?=$date?></span> 邀请人：<span class="glyphicon glyphicon-user" style=color:gray><?=$current_user->login?></span> <span class="user-name-span"><?=$current_user->user_login?></span></p>
            <button class="btn btn-default btn-sm" id="detailTrigger" onclick="showHideEventDetail()">展览详情 <span class="caret"></span></button>
        </div>
        </header><!-- .entry-header -->
        <div class="entry-content" id="eventDetail" style="display:hidden;">
            <?php twentyfourteen_post_thumbnail(); ?>
            <h2>展览信息</h2>
            <table class="table-show">
                <tbody>
                    <tr>
                        <th>展览时间</th>
                        <td><?php
                        echo types_render_field('start-time',array('output'=>'normal')), ' 到 ', types_render_field('end-time',array('output'=>'normal')); ?></td>
                    </tr>
                    <?php
                    $place= types_render_field('place','');
                    if (!empty($place)):
                    ?>
                    <tr>
                        <th>展览场馆</th>
                        <td><?php echo $place; ?></td>
                    </tr>
                    <?php endif;
                    $address  = types_render_field('address','');
                    if (!empty($address)):
                    ?>
                    <tr>
                        <th>展览地址</th>
                        <td><?php echo $address ; ?></td>
                    </tr>
                    <?php endif;
                    $host  =  types_render_field('hosts','');
                    if (!empty($host)):
                    ?>
                    <tr>
                        <th>主办单位</th>
                        <td><?php echo $host; ?></td>
                    </tr>
                    <?php endif;
                    $organizer = wrap_tag(types_render_field('organizer',''),'span','artist', false);
                    if (!empty($organizer)):?>
                    <tr>
                        <th>策展人</th>
                        <td><?php echo implode('、',$organizer); ?></td>
                    </tr>
                    <?php endif;
                    $pid = get_the_ID();
                    $city = get_the_term_list($pid,'city');
                    $artist = get_the_term_list($pid,'artist');
                    if (!empty($artist)):
                    ?>
                    <tr>
                        <th>艺术家</th>
                        <td><?php the_terms($pid,'artist');?></td>
                    </tr>
                    <?php endif;
                    if (!empty($city)):
                    ?>
                    <tr>
                        <th>城市</th>
                        <td><?php the_terms($pid,'city');?></td>
                    </tr>
                    <?php endif;
                    $url = types_render_field('url',array('output'=>'html'));
                    if (!empty($url)):
                    ?>
                    <tr>
                        <th>网址</th>
                        <td><?php echo types_render_field('url',array('output'=>'html')); ?></td>
                    </tr>
                    <?php endif;
                    $phone = types_render_field('phone','');
                    if (!empty($phone)):
                    ?>
                    <tr>
                        <th>联系电话</th>
                        <td><?php echo types_render_field('phone',''); ?></td>
                    </tr>
                    <?php endif;?>
                </tbody>
            </table>
            <div class="show-content">
                <h2>展览介绍</h2>
                <?php echo wrap_tag(types_render_field('description',array('output'=>'raw'))); ?>
            </div>
        </div> <!-- .entry-content -->
    </article><!-- #post-## -->
    <div class="container">
        <button class="btn btn-lg color-red btn-not-rounded btn-block" id="accept-invite">报名参与</button>
    </div>
    <?php
    echo the_join_list($post->ID,false);
    get_template_part('footer','app');
    ?>
    <script type="text/javascript">
        function showHideEventDetail () {
            var triggerNode = document.getElementById('detailTrigger');
            var targetNode = document.getElementById('eventDetail');
            if ( targetNode.classList.toString().indexOf('hidden') == -1 ) {
                targetNode.classList.add('hidden');
                triggerNode.lastChild.classList.remove('rotate-180');
            } else {
                targetNode.classList.remove('hidden')
                triggerNode.lastChild.classList.add('rotate-180');
            }
        }
    </script>
