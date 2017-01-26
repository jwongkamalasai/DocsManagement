<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ldeps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ldep-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ldep', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'depname',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
