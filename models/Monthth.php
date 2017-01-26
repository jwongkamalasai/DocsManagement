<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "monthth".
 *
 * @property string $id
 * @property string $monthnameth
 */
class Monthth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'monthth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monthnameth'], 'required'],
            [['monthnameth'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'monthnameth' => 'Monthnameth',
        ];
    }
    public function getMonth($id){
        if (($model = Monthth::findOne($id)) !== null) {
            return $model->monthnameth;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }   
    }
}
