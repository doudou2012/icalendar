<?php
/**
 * Created by PhpStorm.
 * File: content-city-list.php
 * User: user
 * Date: 15/3/19
 * Time: 下午2:10
 */
$list = array();
$cate = array('name'=>'city');
if (isset($_GET['art-list'])){
    $cate['name'] = 'artist';
}
$list = get_terms($cate,array('order'=>'DESC','orderby'=>'count'));
my_get_header();
?>
<!--<div id="main-content" class="main-content">-->
<div class="city-list">
    <?php if (count($list) > 0): ?>
        <ul class="list-group">
            <?php foreach ($list as $item):?>
            <li class="list-group-item">
                <span class="badge"><?=$item->count?></span>
                <a href="<?=get_term_link($item)?>"><?=$item->name?></a>
            </li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
</div>
<?php my_get_footer();?>