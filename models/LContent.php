<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "l_content".
 *
 * @property string $id
 * @property string $content
 */
class LContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'content'], 'required'],
            [['id'], 'string', 'max' => 2],
            [['content'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }
    public function getContent($id)
    {
        if (($model = LContent::findOne($id)) !== null) {
            return $model->content;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }       
    }
}
