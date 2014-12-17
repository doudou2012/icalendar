<?php
/**
 * The default template for displaying content-show
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) && twentyfourteen_categorized_blog() ) : ?>
		<div class="entry-meta">
			<span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'twentyfourteen' ) ); ?></span>
		</div>
		<?php
			endif;

			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			endif;
		?>
	</header><!-- .entry-header -->

    <?php twentyfourteen_post_thumbnail(); ?>
	<div class="entry-content">
        <h2>展览信息</h2>
        <table class="table-show">
            <tbody>
            <tr>
                <th>展览时间</th>
                <td><?php   echo types_render_field('start-time',array('output'=>'normal')), '  -   ', types_render_field('end-time',array('output'=>'normal')); ?></td>
            </tr>
            <tr>
                <th>展览场馆</th>
                <td><?php echo types_render_field('place',''); ?></td>
            </tr>
            <tr>
                <th>展览地址</th>
                <td><?php echo types_render_field('address',''); ?></td>
            </tr>
            <tr>
                <th>主办单位</th>
                <td><?php echo types_render_field('hosts',''); ?></td>
            </tr>
            <tr>
                <th>策展人</th>
                <td><?php
                    $organizer = wrap_tag(types_render_field('organizer',''),'span','artist', false);
                    echo implode('、',$organizer);
                    ?></td>
            </tr>
            <tr>
                <th>网址</th>
                <td><?php
                    echo  types_render_field('url',array('output'=>'html'));
                    ?>
                </td>
            </tr>
            <tr>
                <th>联系电话</th>
                <td><?php echo types_render_field('phone',''); ?></td>
            </tr>
            </tbody>
        </table>
        <div class="show-content">
            <h2>展览介绍</h2>
            <?php
                echo wrap_tag(types_render_field('description',array('output'=>'raw')));
            ?>
        </div>

	</div> <!-- .entry-content -->
</article><!-- #post-## -->
