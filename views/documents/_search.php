<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DocumentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content_id') ?>

    <?= $form->field($model, 'doc_id') ?>

    <?= $form->field($model, 'years') ?>

    <?= $form->field($model, 'docno') ?>

    <?php // echo $form->field($model, 'doc_date') ?>

    <?php // echo $form->field($model, 'doc_form') ?>

    <?php // echo $form->field($model, 'doc_to') ?>

    <?php // echo $form->field($model, 'topic') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'ref') ?>

    <?php // echo $form->field($model, 'deps') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'd_update') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
