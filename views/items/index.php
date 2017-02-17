<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\ItemGroup;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการพัสดุ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มพัสดุ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                'header' => 'ลำดับ'
            ],
            //'itemID',
            [
                'attribute' => 'itemname',
                'headerOptions' => ['style' => 'width:40%'],
            ],
            //'description',
            [ 
                'attribute' =>'itemgroup' ,
                'headerOptions' => ['style' => 'width:15%'],
                'filter' => ArrayHelper::map(ItemGroup::find()->all(),'group_id','groupname'),
                'value'=>function($model, $key, $index, $column)
                {
                    return ItemGroup::getItemGroup($model->itemgroup);
                    }
            ],
            'stock',
            'unit',
            ['class' => 'yii\grid\ActionColumn',
                'header'=>'การจัดการ',
                'headerOptions' => ['style' => 'width:20%'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {detail} {edit} {del} </div>',
                'buttons'=>[
                    'detail' => function($url,$model,$key){
                        return Html::a('รายละเอียด',
                            ['view', 'id' => $model->itemID],
                            ['class' => 'btn btn-primary'],
                            $url);
                    },
                    'edit' => function($url,$model,$key){
                        return Html::a('ปรับปรุง',
                            ['update', 'id' => $model->itemID],
                            ['class' => 'btn btn-success'],
                            $url);
                    },
                    'del' => function($url,$model,$key){
                        return Html::a('ลบ',
                            ['delete', 'id' => $model->itemID],
                            ['class' => 'btn btn-danger'],
                            $url);
                    },
                ],            
            ],
        ],
    ]); ?>
</div>
