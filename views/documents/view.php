<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\i18n\Formatter;

use app\models\Monthth;
use app\models\LContent;
use app\models\LDep;
/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = $model->docno;
$this->params['breadcrumbs'][] = ['label' => 'งานเอกสาร/หนังสือ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Yii::$app->formatter->locale = 'th';

?>
<div class="documents-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th{captionOptions} width=150>{label}</th><td{contentOptions}>{value}</td></tr>',
        'attributes' => [
            //'id',
            [ 
                'attribute' =>'content_id' ,
                'value'=>lcontent::getContent($model->content_id),
            ],
            [
                'attribute' =>'doc_id' ,
                'value'=>$model->doc_id.'/'.$model->years,
            ],
//            'doc_id',
//            'years',
            'docno',
            [
                'attribute' => 'doc_date',
                'value' => Yii::$app->thaiFormatter->asDate($model->doc_date, 'd').' '.Monthth::getMonth(Yii::$app->thaiFormatter->asDate($model->doc_date, 'M')).' '.Yii::$app->thaiFormatter->asDate($model->doc_date, 'Y'),
            ],
            //'doc_date:date',
            'doc_form',
            'doc_to',
            'topic',
            'detail:ntext',
            //'ref',
            [ 
                'attribute' =>'deps' ,
                'value'=>lDep::getDep($model->deps),
            ],
            'register',
            'comment',
            [
                'attribute' => 'date_receive',
                'value' => Yii::$app->thaiFormatter->asDate($model->date_receive, 'd').' '.Monthth::getMonth(Yii::$app->thaiFormatter->asDate($model->date_receive, 'M')).' '.Yii::$app->thaiFormatter->asDate($model->date_receive, 'Y'),
            ],
        ],
    ]) ?>
    <p>
    <?php if(!Yii::$app->user->isGuest){if(Yii::$app->user->identity->role == 1){ ?>
        <?= Html::a('บันทึกแก้ไขเอกสาร', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบเอกสาร', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php }
    } ?>
    <?= Html::a('ดาวน์โหลดเอกสาร', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
