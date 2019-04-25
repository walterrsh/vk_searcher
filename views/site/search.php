<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title = 'Search';
?>
<div class="vk-search">

    <div class="body-content">

        <div class="row">

            <?php foreach($posts->items as $model):?>
                <?= $this->render('_item_post', ['model' => $model]) ?>
            <?php endforeach; ?>

            <?php if (property_exists($posts, "next_from")): ?>

            <?=\yii\bootstrap\Html::a("Next Page", ['site/search', 'q' => $q, 'start_from' => $posts->next_from], ['class' => 'btn btn-primary pull-right'])?>

            <?php endif; ?>

        </div>

    </div>
</div>
