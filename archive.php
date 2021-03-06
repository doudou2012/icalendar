<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Fourteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

my_get_header();
?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
            <?php if(ua_icalendar_app()):?>
			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );

						else :
							_e( 'Archives', 'twentyfourteen' );

						endif;
					?>
				</h1>
			</header>
            <?php endif;?>
			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
                        $content_name = '';
                        if  (wp_is_mobile() && is_single()):
                            $content_name = 'mobile-single';
                        else:
                            $content_name =  get_post_format();
                        endif;
                        get_template_part( 'content',$content_name);
//						get_template_part( 'content', get_post_format() );

					endwhile;
					// Previous/next page navigation.
                    if (!ua_icalendar_app()):
					    twentyfourteen_paging_nav();
                    endif;
				else :
					// If no content, include the "No posts found" template.
                    if ( isset($_GET['favorite'])):
                        get_template_part( 'content', 'none-favorite' );
					else:
                        get_template_part( 'content', 'none' );

                    endif;

				endif;
			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php
if (!wp_is_mobile()){
    get_sidebar( 'content' );
    get_sidebar();
}
//get_sidebar( 'content' );
//get_sidebar();
my_get_footer();
