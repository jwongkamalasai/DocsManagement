<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "download".
 *
 * @property string $id
 * @property string $ref
 * @property string $download_by
 * @property string $download_date
 */
class Download extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref', 'download_by'], 'required'],
            [['ref'], 'string', 'max' => 50],
            [['download_date'], 'safe'],
            [['download_by'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'Reference',
            'download_by' => 'Download By',
            'download_date' => 'Download Date',
        ];
    }
    public function findDocs($id)
    {
        if (($model = Download::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
