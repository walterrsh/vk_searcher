<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
                <?= $form->field($model, 'q'); ?>
                <?= \yii\bootstrap\Html::submitButton(\Yii::t("app", "Search"), ['class' => 'btn btn-success']); ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>

    </div>
</div>
