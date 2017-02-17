<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItemList */

$this->title = $model->itemID;
$this->params['breadcrumbs'][] = ['label' => 'Item Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->itemID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->itemID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'itemID',
            'itemname',
            'description',
            'itemgroup',
            'unit',
            'stock',
        ],
    ]) ?>

</div>
