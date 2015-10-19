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
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/webridge.js'></script>
         <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/layer/layer.min.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/icalendar.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.excoloSlider.min.js'></script>
<!--        <script type='text/javascript' src='--><?php //echo get_template_directory_uri();?><!--/js/wowslider/script.js'></script>-->
    <?php endif;?>
 <script type="text/javascript">
     var isSingle = <?=  is_single() ? true : false?>
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
        if (!isSingle)
            $('.post-thumbnail img').css('max-height','230px');
	$(document.body).css({"overflow-x":"hidden","overflow-y":"hidden" });
 });
 </script>
<?php
if (ua_icalendar_app()){
    $cities = get_terms(array('name'=>'city'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    $artist = get_terms(array('name'=>'artist'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    ?>
<div class="cityArtistMenuBg hidden">
  <div class="cityArtistMenu">
    <h3>城市</h3>
    <ul>
      <?php if (count($cities) > 0):?>
      <?php foreach ($cities as $city):?>
        <li><em>●</em><a href="<?=get_term_link($city)?>"><?=$city->name?></a></li>
      <?php endforeach;?>
      <?php endif;?>
      <li><a href="<?=home_url().'?city-list'?>" >更多»</a></li>
    </ul>
    <h3>艺术家</h3>
    <ul>
      <?php if (count($artist) > 0):?>
      <?php foreach ($artist as $art):?>
      <li><em>●</em><a href="<?=get_term_link($art)?>"><?=$art->name?></a></li>
      <?php endforeach;?>
      <?php endif;?>
      <li><a href="" >更多»</a></li>
    </ul>
    <h3 id="clabout">关于</h3>
    
  </div>
    
<script type="text/javascript">

    $('#clabout').click(function(){
        location.href = "http://icalendar.bbwc.cn/about.html";
    });
    function showHideCityMenu () {
        var cityMenu = document.getElementsByClassName('cityArtistMenuBg')[0];
        if (cityMenu.classList.toString().indexOf('hidden') == -1) {
            cityMenu.classList.add('hidden');
            document.body.style.overflow = 'scroll';
            document.body.style.height = 'auto';
        } else {
            cityMenu.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.body.style.height = window.innerHeight.toString() + 'px';
        }
    }
    var menuToggle = document.getElementsByClassName('nav-city');
    for (var i = menuToggle.length - 1; i >= 0; i--) {
        menuToggle[i].addEventListener('click', showHideCityMenu);
    };
    var menuBg = document.getElementsByClassName('cityArtistMenuBg')[0];
    menuBg.addEventListener('click', showHideCityMenu);
</script>
<?php }
?>
</body>
</html>
