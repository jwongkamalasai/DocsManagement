<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_group".
 *
 * @property integer $group_id
 * @property string $groupname
 */
class ItemGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'required'],
            [['group_id'], 'integer'],
            [['groupname'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'group_id' => 'Group ID',
            'groupname' => 'ประเภทวัสดุ',
        ];
    }
    public function getItemGroup($id)
    {
        if (($model = ItemGroup::findOne($id)) !== null) {
            return $model->groupname;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }       
    }
}
