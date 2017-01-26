<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\DocReply;
use app\models\Documents;
use app\models\DocumentsSearch;
use app\controller\DocumentsController;
use yii\grid\GridView;
use app\models\LContent;
use app\controller\LContentController;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\LDep;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;

$this->title = 'รายการเอกสาร';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

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
                    return lDep::getDep($model->deps);
                    }
            ],
            // 'location',
            // 'comment',
            // 'd_update',

            ['class' => 'yii\grid\ActionColumn',
                'header'=>'รายละเอียด',
                'template'=>'{link}     {download}',
                'buttons'=>[
                    'link' => function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-link"></i>',$url);
                    },
                    'download' => function($url,$model,$key){
                        return Html::a('<i class="glyphicon glyphicon-download"></i>',$url);
                    }

                ]
            ],
        ],
    ]); ?>
</div>
