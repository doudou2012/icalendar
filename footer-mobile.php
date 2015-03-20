<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
        </div><!-- #main -->
    </div><!-- #page -->
<script type='text/javascript' src='http://libs.baidu.com/jquery/2.0.0/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/functions.js'></script>
<?php
    if (ua_icalendar_app()):
?>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/alertify.min.js"></script>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/account/static/sign.js"></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.flexslider.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/webridge.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/icalendar.js'></script>
    <?php endif;?>
 <script type="text/javascript">
 $(document).ready(function(){
 	var ua = navigator.userAgent,
        reg = /Slate/;
	if (reg.test(ua)) {
		<?php if (get_query_var('paged') == 1 || !(get_query_var('paged'))):?>
		// $(document.body).css({"padding-top":"74px","background-color":"#fff"});
		$('.site').css('max-width','670px');
		$('.site-header').css('max-width','670px');
		<?php endif;?>
	};
	$('.post-thumbnail img').css('max-height','230px');
	$(document.body).css({"overflow-x":"hidden","overflow-y":"hidden" });
 });
 </script>
<?php
if (ua_icalendar_app()){
    $cities = get_terms(array('name'=>'city'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    $artist = get_terms(array('name'=>'artist'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    ?>
    <div class="jumbotron hidden" id="city-artist" >
        <p>热门城市</p>
        <ul>
            <?php if (count($cities) > 0):?>
                <?php foreach ($cities as $city):?>
                    <li><a href=""><?=$city->name?></a></li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
        <p><a href="" class="pull-right">more>>></a> </p>
        <p>热门艺术家</p>
        <ul>
            <?php if (count($artist) > 0):?>
                <?php foreach ($artist as $art):?>
                    <li><a href=""><?=$art->name?></a></li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
        <p><a href="" class="pull-right">more>>></a> </p>
    </div>
<?php }
?>
</body>
</html>
