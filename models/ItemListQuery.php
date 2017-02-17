<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ItemList]].
 *
 * @see ItemList
 */
class ItemListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ItemList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItemList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
