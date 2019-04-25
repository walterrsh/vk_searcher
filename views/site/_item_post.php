<div class="col-sm-4 feed_item">
    <div class="feed_item-meta">
        <div class="col-sm-6 pull-left">
            <span class="glyphicon glyphicon-time"></span><?= date("Y.m.d H:i", $model->date) ?>
        </div>
        <div class="col-sm-6 pull-right">
            <span class="glyphicon glyphicon-hand-up"></span><?= $model->likes->count ?>
        </div>
    </div>
    <div class="feed_item-text">
        <a href="<?=\Yii::$app->urlManager->createUrl(['site/view', 'id' => $model->id])?>">
            <?= strlen($model->text) > 90 ? mb_substr(strip_tags($model->text), 0, 87, "UTF-8") . "..." : $model->text ?>
        </a>
    </div>
</div>

<style>
    .feed_item {
        min-height: 200px;
        max-height: 300px;
        overflow: hidden;
    }
</style>