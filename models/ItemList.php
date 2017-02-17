<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\ItemGroup;

/**
 * This is the model class for table "item_list".
 *
 * @property string $itemID
 * @property string $itemname
 * @property string $description
 * @property integer $itemgroup
 * @property string $unit
 * @property integer $stock
 */
class ItemList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemname', 'description'], 'required'],
            [['itemgroup', 'stock'], 'integer'],
            [['itemname'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemID' => Yii::t('app', 'Item ID'),
            'itemname' => Yii::t('app', 'รายการ'),
            'description' => Yii::t('app', 'รายละเอียด'),
            'itemgroup' => Yii::t('app', 'ประเภทพัสดุ'),
            'unit' => Yii::t('app', 'หน่วยนับ'),
            'stock' => Yii::t('app', 'คงเหลือ'),
        ];
    }

    /**
     * @inheritdoc
     * @return ItemListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ItemListQuery(get_called_class());
    }

    public function getItemGroup(){
        return $this->hasOne(ItemGroup::className(),['group_id'=>'itemgroup']);
    }
}
