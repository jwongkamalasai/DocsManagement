<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LDep */

$this->title = 'Create Ldep';
$this->params['breadcrumbs'][] = ['label' => 'Ldeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ldep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
