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
 <script type="text/javascript">
 $(document).ready(function(){
 	var ua = navigator.userAgent,
        reg = /Slate/;
	if (reg.test(ua)) {
		$('#page').css('max-width','670px');
	};
	$('.post-thumbnail img').css('max-height','230px');
	$(document.body).css({"overflow-x":"hidden","overflow-y":"hidden" });
 });
 </script>
</body>
</html>