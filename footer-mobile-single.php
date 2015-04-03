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
<?php if (wp_is_mobile() && is_single()):?>
    <script type='text/javascript' src='http://libs.baidu.com/jquery/2.0.0/jquery.min.js'></script>
    <?php  if (ua_icalendar_app()):?>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/alertify.min.js"></script>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/account/static/sign.js"></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/webridge.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/layer/layer.min.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/icalendar.js'></script>
    <?php endif;?>
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.excoloSlider.min.js'></script>
<?php endif;?>
    </div><!-- #page -->
</body>
</html>
