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
    if (preg_match('/iArt\s+Calendar/',$_SERVER['HTTP_USER_AGENT'])):
?>
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
</body>
</html>
