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
		<!--
		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php //get_sidebar( 'footer' ); ?>

		</footer> -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
<?php
//if (ua_icalendar_app()){
    $cities = get_terms(array('name'=>'city'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    $artist = get_terms(array('name'=>'artist'),array('order'=>'DESC','orderby'=>'count','number'=>6));
    ?>
    <div class="jumbotron" id="city-artist" >
        <p>热门城市 <span class="pull-right"><a href="<?=home_url().'?city-list'?>" >more>>></a></span></p>
        <ul class="list-inline">
            <?php if (count($cities) > 0):?>
                <?php foreach ($cities as $city):?>
                    <li><a href=""><?=$city->name?></a></li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
        <p> </p>
        <p>热门艺术家 <span class="pull-right"><a href="<?=home_url().'?art-list'?>" >more>>></a></span></p>
        <ul class="list-inline">
            <?php if (count($artist) > 0):?>
                <?php foreach ($artist as $art):?>
                    <li><a href=""><?=$art->name?></a></li>
                <?php endforeach;?>
            <?php endif;?>
        </ul>
    </div>
</body>
</html>
