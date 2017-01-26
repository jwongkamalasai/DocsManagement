<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "l_dep".
 *
 * @property string $id
 * @property string $depname
 */
class LDep extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_dep';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'depname'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['depname'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'depname' => 'Depname',
        ];
    }
    public function getDep($id)
    {
        if (($model = LDep::findOne($id)) !== null) {
            return $model->depname;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }       
    }
}
