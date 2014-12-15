<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

my_get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
                    $content_name = '';
                    if  (wp_is_mobile() || (!wp_is_mobile() && !is_user_logged_in())):
                        $content_name = 'show';
                    else:
                        $content_name =  get_post_format();
                    endif;
                    get_template_part( 'content',$content_name);
					// Previous/next post navigation.
//					twentyfourteen_post_nav();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				endwhile;
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
//get_sidebar( 'content' );
//get_sidebar();
my_get_footer();
