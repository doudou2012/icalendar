<?php
/**
 * Created by PhpStorm.
 * File: content-city-list.php
 * User: user
 * Date: 15/3/19
 * Time: 下午2:10
 */
$categories = get_terms(array('name'=>'city'));
?>
<div class="city-list">
    <?php if (count($categories) > 0): ?>
        <ul class="list-group">
            <?php foreach ($categories as $category):?>
            <li class="list-group-item">
                <span class="badge"><?=$category->count?></span>
                <?=$category->name;?>
            </li>
            <?php endforeach;?>
        </ul>
    <?php endif;?>
</div>