<?php
/**
 * Created by PhpStorm.
 * File: content-city-list.php
 * User: user
 * Date: 15/3/19
 * Time: 下午2:10
 */
$cities = get_terms(array('name'=>'city'),array('order'=>'DESC','orderby'=>'count','number'=>10));
my_get_header();
?>
<!--<div id="main-content" class="main-content">-->
<div class="city-list">
    <?php if (count($cities) > 0): ?>
        <ul class="list-group">
            <?php foreach ($cities as $city):?>
            <li class="list-group-item">
                <span class="badge"><?=$city->count?></span>
                <?=$city->name;?>
            </li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
</div>
<!--</div><!-- #main-content -->-->
<?php my_get_footer();?>