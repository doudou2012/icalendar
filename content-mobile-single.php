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
//$categories = get_terms(array('name'=>'city'));
$isFav = check_fav(get_the_ID());
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
    <?php if (ua_icalendar_app()):?>
        <p ><button type="button" id="add_fav" class="btn btn-link pull-right"><i class="glyphicon <?= $isFav ? ' glyphicon-heart' : ' glyphicon-heart-empty' ?>"></i>收藏</button></p>
    <?php endif;?>
    <?php
    $str = types_render_field('images',array('output'=>'raw','width'=>'400','height'=>'300','proportional'=>"true",'url'=>true));
    if ($str) {
        $images = explode(' ',$str);
//        $showBullet = wp_is_mobile()?false:true;
        echo renderSliderImages($images);
    }else{
        twentyfourteen_post_thumbnail();
    }

    ?>
	<div class="entry-content">
        <?php if (ua_icalendar_app()):?>
        <div class="btn-container">
            <button class="btn btn-lg btn-not-rounded btn-half-width color-red" id="add_fav" ><i class="glyphicon <?= $isFav ? 'glyphicon-heart' : 'glyphicon-heart-empty' ?>"></i> 想去</button>
            <button class="btn btn-lg btn-not-rounded btn-half-width color-red pull-right" id="invite-friends"><i class="glyphicon glyphicon-share-alt"></i> 邀请好友</button>
        </div>
        </div>
        <?php endif;?>
        <h2>展览信息</h2>
        <table class="table-show">
            <tbody>
            <tr>
                <th>时间</th>
                <td><?php   echo types_render_field('start-time',array('output'=>'normal')), ' 到 ', types_render_field('end-time',array('output'=>'normal')); ?></td>
            </tr>
            <?php
                $place= types_render_field('place','');
                if (!empty($place)):
            ?>
            <tr>
                <th>场馆</th>
                <td><?php echo $place; ?></td>
            </tr>
            <?php endif;
                $address  = types_render_field('address','');
                if (!empty($address)):
            ?>
            <tr>
                <th>地址</th>
                <td><?php echo $address ; ?></td>
            </tr>
           <?php endif;
                $url = types_render_field('url','');
                if ($url):
            ?>
                    <tr>
                        <th>网址</th>
                        <td><?php echo $url ; ?></td>
                    </tr>
                    <?php endif;
            $host  =  types_render_field('hosts','');
            if (!empty($host)):
            ?>
            <tr>
                <th>主办方</th>
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
            $phone = types_render_field('phone','');
            if (!empty($phone)):
            ?>
            <tr>
                <th>电话</th>
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
<?=the_join_list(get_the_ID(),true)?>
