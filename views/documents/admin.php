<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\LContent;
use app\models\LDep;

use yii\helpers\ArrayHelper;
//use kartik\date\DatePicker;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'งานเอกสาร/หนังสือ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างเอกสาร/หนังสือ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [ 
                'attribute' =>'content_id' ,
                'filter' => ArrayHelper::map(LContent::find()->all(),'id','content'),
                'value'=>function($model, $key, $index, $column)
                {
                    return lcontent::getContent($model->content_id);
                    }
            ],
//            'content',
/*
            [ 
                'attribute' => 'doc_id',
                'headerOptions' => ['style' => 'width:10%'],
            ],

            [ 
                'attribute' => 'years',
                'headerOptions' => ['style' => 'width:10%'],
            ],
*/
            'docno',
            [
                'attribute' => 'doc_date',
                'value' => 'doc_date',
 //               'format' => 'Y-M-d',
                'filter' => DatePicker::widget([
                    'model' => $searchModel, 
                    'attribute' => 'doc_date',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]),
            ],
 //           'doc_date:date',
            // 'doc_form',
            // 'doc_to',

            [ 
                'attribute' => 'topic',
                'headerOptions' => ['style' => 'width:30%'],
            ],        
            // 'detail:ntext',
            // 'ref',
            [ 
                'attribute' =>'deps' ,
                'filter' => ArrayHelper::map(LDep::find()->all(),'id','depname'),
                'value'=>function($model, $key, $index, $column)
                {
                    return LDep::getDep($model->deps);
                    }
            ],
            // 'location',
            // 'comment',
            // 'd_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
