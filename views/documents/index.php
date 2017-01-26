<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\LContent;
use app\models\LDep;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'งานเอกสาร/หนังสือ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'label' => 'เลขที่เอกสาร/หนังสือ',
                'format' => 'html',
                'value' => function( $model, $key,$ index, $column) {
                    return $model->title.$model->doc_no.'/'.$model.years; 
                }
                'headerOptions' => ['style' => 'width:10%'],
            ],
*/
            'docno',
            // 'doc_date',
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
            // ['attribute'=>'others','value'=>function($model){return $model->listDownloadFiles('others');},'format'=>'html'],

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'',
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {detail} </div>',
                'buttons'=>[
                    'detail' => function($url,$model,$key){
                        return Html::a('รายละเอียด',
                            ['view', 'id' => $model->id],
                            ['class' => 'btn btn-primary'],
                            $url);
                    },
                ]
            ],

        ],
        'pager' => [
        'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
        'prevPageLabel' => 'Previous',   // Set the label for the “previous” page button
        'nextPageLabel' => 'Next',   // Set the label for the “next” page button
        'firstPageLabel'=> 'First',   // Set the label for the “first” page button
        'lastPageLabel'=> 'Last',    // Set the label for the “last” page button
        ],
    ]); ?>
</div>
