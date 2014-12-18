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
    <footer id="colophon" class="site-footer" role="contentinfo">
        <div id="supplementary">
            <div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
                <aside id="search-4" class="widget widget_search"><form role="search" method="get" class="search-form" action="http://10.0.41.31/">
                        <label>
                            <span class="screen-reader-text">搜索：</span>
                            <input type="search" class="search-field" placeholder="搜索&hellip;" value="" name="s" title="搜索：" />
                        </label>
                        <input type="submit" class="search-submit" value="搜索" />
                    </form></aside>	</div><!-- #footer-sidebar -->
        </div><!-- #supplementary -->
    </footer>
<?php endif;?>
    </div><!-- #page -->
</body>
</html>