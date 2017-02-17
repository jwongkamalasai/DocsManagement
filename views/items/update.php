<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItemList */

$this->title = 'Update Item List: ' . $model->itemID;
$this->params['breadcrumbs'][] = ['label' => 'Item Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->itemID, 'url' => ['view', 'id' => $model->itemID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
