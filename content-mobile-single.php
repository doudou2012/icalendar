<?php
/**
 *
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

    <?php 
    $str = types_render_field('images',array('output'=>'raw','width'=>'400','height'=>'300','proportional'=>"true",'url'=>true));
    if ($str) {
        $images = explode(' ',$str);
        $html = '<div class="flexslider"><ul class="slides">';
        foreach ($images as  $value) {
            $html.= '<li><img src="'.$value.'" /> </li>';
        }
        $html.='</ul></div>';
        echo $html;
    }else{
        twentyfourteen_post_thumbnail();
    }
    // $html = getThumbImages();
    //  if ($html){
    //     echo $thml;
    //  }else{
    //     twentyfourteen_post_thumbnail();
    //  }
    ?>
	<div class="entry-content">
        <h2>展览信息</h2>
        <table class="table-show">
            <tbody>
            <tr>
                <th>展览时间</th>
                <td><?php   echo types_render_field('start-time',array('output'=>'normal')), '&nbsp;  -   &nbsp;', types_render_field('end-time',array('output'=>'normal')); ?></td>
            </tr>
            <?php
                $place= types_render_field('place','');
                if (!empty($place)):
            ?>
            <tr>
                <th>展览场馆</th>
                <td><?php echo $place; ?></td>
            </tr>
            <?php endif;
                $address  = types_render_field('address','');
                if (!empty($address)):
            ?>
            <tr>
                <th>展览地址</th>
                <td><?php echo $address ; ?></td>
            </tr>
           <?php endif;
            $host  =  types_render_field('hosts','');
            if (!empty($host)):
            ?>
            <tr>
                <th>主办单位</th>
                <td><?php echo $host; ?></td>
            </tr>
            <?php endif;
            $organizer = wrap_tag(types_render_field('organizer',''),'span','artist', false);
            if (!empty($organizer)):?>
            <tr>
                <th>策展人</th>
                <td><?php
                    echo implode('、',$organizer);
                    ?></td>
            </tr>
            <?php endif;
            $pid = get_the_ID();
            $city = get_the_term_list($pid,'city');
            $artist = get_the_term_list($pid,'artist');
            if (!empty($artist)):
            ?>
            <tr>
                <th>艺术家</th>
                <td>
                    <?php the_terms($pid,'artist');?>
                </td>
            </tr>
            <?php endif;
            if (!empty($city)):
            ?>
                <tr>
                    <th>城市</th>
                    <td>
                        <?php the_terms($pid,'city');?>
                    </td>
                </tr>
                <?php endif;
            $url = types_render_field('url',array('output'=>'html'));
            if (!empty($url)):
            ?>
            <tr>
                <th>网址</th>
                <td><?php
                    echo  types_render_field('url',array('output'=>'html'));
                    ?>
                </td>
            </tr>
            <?php endif;
            $phone = types_render_field('phone','');
            if (!empty($phone)):
            ?>
            <tr>
                <th>联系电话</th>
                <td><?php echo types_render_field('phone',''); ?></td>
            </tr>
            <?php endif;?>
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
