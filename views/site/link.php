<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Documents;

use app\models\Uploads;
/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = $model->docno;
$this->params['breadcrumbs'][] = ['label' => 'Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'template' => '<tr><th width=150>{label}</th><td>{value}</td></tr>',
        'attributes' => [
//            'id',
//            'content_id',
            [  
                'label' => 'ลำดับที่',
                'value' => $model->doc_id.'/'.$model->years,
            ],
//            'doc_id',
//            'years',
            'docno',
            'doc_date',
            'doc_form',
            'doc_to',
            'topic',
            'detail:ntext',
//            'ref',

            'deps',
            'location',
            'comment',
            'd_update',
        ],
    ]) ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->docno)]);?>
        </div>
    </div>
    <p>
        <?= Html::a('Download', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
