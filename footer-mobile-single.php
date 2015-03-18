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
    <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/jquery.flexslider.js'></script>
    <?php  if (ua_icalendar_app()):?>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/static/alertifyjs/alertify.min.js"></script>
        <script type="text/javascript" src="<?=WP_PLUGIN_URL?>/wxrobot/account/static/sign.js"></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/webridge.js'></script>
        <script type='text/javascript' src='<?php echo get_template_directory_uri();?>/js/icalendar.js'></script>
    <?php endif;?>
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div id="supplementary">
            <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
                <aside id="search-4" class="widget widget_search"><form role="search" method="get" class="search-form" action="http://<?php echo $_SERVER['SERVER_NAME']?>/">
                        <label>
                            <input type="search" class="search-field" placeholder="搜索&hellip;" value="" name="s" title="搜索：" />
                        </label>
                        <input type="submit" class="search-submit" value="搜索" />
                    </form></aside>	</div><!-- #footer-sidebar -->
        </div><!-- #supplementary -->
    </footer>
    <script type="text/javascript">
        $(document).ready(function(){
            if ($('.flexslider').length > 0){
                $('.flexslider').flexslider({"smoothHeight":true});
            }
        });
    </script>
<?php endif;?>
    </div><!-- #page -->
</body>
</html>
