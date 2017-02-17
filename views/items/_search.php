<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'itemID') ?>

    <?= $form->field($model, 'itemname') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'itemgroup') ?>

    <?= $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
