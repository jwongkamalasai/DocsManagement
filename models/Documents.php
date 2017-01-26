<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\LConent;
use app\models\LDep;
use yii\helpers\Json;

/**
 * This is the model class for table "documents".
 *
 * @property string $id
 * @property string $content_id
 * @property integer $doc_id
 * @property integer $years
 * @property string $docno
 * @property string $doc_date
 * @property string $doc_form
 * @property string $doc_to
 * @property string $topic
 * @property string $detail
 * @property string $ref
 * @property string $deps
 * @property string $location
 * @property string $comment
 * @property string $date_receive
 * @property string $others
 * @property string $docs
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * @inheritdoc
     */
    const UPLOAD_FOLDER='documents/data';

    public function rules()
    {
        return [
            [['content_id', 'doc_id', 'years', 'docno', 'doc_date', 'doc_form', 'doc_to', 'topic' , 'register' ], 'required'],
            [['doc_id', 'years'], 'integer'],
            [['doc_date', 'date_receive'], 'safe'],
            [['detail'], 'string'],
            [['content_id', 'deps' ], 'string', 'max' => 2],
            [['docno', 'doc_form', 'doc_to', 'ref'], 'string', 'max' => 50],
            [['topic', 'register', 'comment'], 'string', 'max' => 255],
            [['docno'], 'unique'],
            [['ref'], 'unique'],
            [['others'],'file','maxFiles'=>1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'หมวดเอกสาร',
            'doc_id' => 'ลำดับ',
            'years' => 'ปี',
            'docno' => 'เลขที่เอกสาร/หนังสือ',
            'doc_date' => 'ลงวันที่',
            'doc_form' => 'จาก',
            'doc_to' => 'ถึง',
            'topic' => 'เรื่อง',
            'detail' => 'รายละเอียด',
            'ref' => 'Ref',
            'deps' => 'ฝ่าย/กลุ่มงาน',
            'register' => 'ผู้รับหนังสือ',
            'comment' => 'หมายเหตุ',
            'date_receive' => 'วันที่รับหนังสือ',
            'others' => 'ไฟล์'
        ];
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function listDownloadFiles($type){
     $docs_file = '';
     if(in_array($type, ['others'])){
             $data = $type==='docs'?$this->docs:$this->others;
             $files = Json::decode($data);
            if(is_array($files)){
                 $docs_file ='<ul>';
                 foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['/documents/data','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
                 }
                 $docs_file .='</ul>';
            }
     }
     return $docs_file;
    }

    public function initialPreview($data,$field,$type='file'){
            $initial = [];
            $files = Json::decode($data);
            if(is_array($files)){
                 foreach ($files as $key => $value) {
                    if($type=='file'){
                        $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                    }elseif($type=='config'){
                        $initial[] = [
                            'caption'=> $value,
                            'width'  => '120px',
                            'url'    => Url::to(['/documents/data/deletefile','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                            'key'    => $key
                        ];
                    }
                    else{
                        $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                    }
                 }
         }
        return $initial;
    }
/*  
    public function getThumbnails($ref,$event_name){
        $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }
*/    
    public function findModel($id)
    {
        if (($model = Documents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function getDep(){
        return $this->hasOne(LDep::className(),['id'=>'deps']);
    }

    public function getContent(){
        return $this->hasOne(LContent::className(),['id'=>'content_id']);
    }
}
