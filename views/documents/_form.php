<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use app\models\LContent;
use app\models\LDep;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-sm-3 col-md-3">
            <?= $form->field($model, 'content_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(LContent::find()->all(),'id','content'),
                'options' => ['placeholder' => 'เลือกหมวดหนังสือ...'],
                'pluginOptions' => ['allowClear' => true],])->label('หมวดเอกสาร')
            ?>
        </div>        
        <div class="col-sm-3 col-md-2">
            <?= $form->field($model, 'doc_id')->textInput()->label('เลขที่รับ') ?>
        </div>
        <div class="col-sm-3 col-md-2">
            <?= $form->field($model, 'years')->textInput()->label('ปี')?>
        </div>
    </div>

    <?= $form->field($model, 'docno')->textInput(['maxlength' => true])->label('เลขที่เอกสาร/่หนังสือ') ?>

    <div class="row">
        <div class="col-sm-6 col-md-4">    
            <?= $form->field($model, 'doc_date')->widget(
                DatePicker::className(), [
                    'language' => 'th',
                    'options' => ['placeholder' => 'Select issue date ...'],
                        'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true ]
                ])->label('วันที่ตามเอกสารที่รับ') 
            ?>
        </div>
        <div class="col-sm-6 col-md-4">    
            <?= $form->field($model, 'date_receive')->widget(
                DatePicker::className(), [
                    'language' => 'th',
                    'options' => ['placeholder' => 'Select issue date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true ]
                ])->label('วันที่ลงรับเอกสาร/หนังสือ') 
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4">    
            <?= $form->field($model, 'doc_form')->textInput(['maxlength' => true])->label('เอกสาร/หนังสือ จาก') ?>
        </div>
        <div class="col-sm-6 col-md-4">
            <?= $form->field($model, 'doc_to')->textInput(['maxlength' => true])->label('เอกสาร/หนังสือ ถึง') ?>
        </div>
    </div>
    <?= $form->field($model, 'topic')->textInput(['maxlength' => true])->label('เรื่อง') ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6])->label('รายละเอียด') ?>

    <?= $form->field($model, 'others')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'initialPreview'=>$model->initialPreview($model->others,'others','file'),
            'initialPreviewConfig'=>$model->initialPreview($model->others,'others','config'),
            'allowedFileExtensions'=>['zip','pdf','rar','ZIP','RAR','PDF'],
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
     ]
    ]); ?>
    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false);  ?>

    <?= $form->field($model, 'deps')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(LDep::find()->all(),'id','depname'),
                'options' => ['placeholder' => 'ส่งต่อเอกสาร/หนังสือ...'],
                'pluginOptions' => ['allowClear' => true],])->label('ส่งต่อเอกสาร/หนังสือ ไปยัง')
    ?>

    <?= $form->field($model, 'register')->textInput(['maxlength' => true])->label('ผู้รับเอกสาร') ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true])->label('หมายเหตุ') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'บันทึก' : 'บันทึกแก้ไข', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
