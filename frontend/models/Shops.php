<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shops".
 *
 * @property int $shop_id
 * @property string $shop_name
 * @property string $shop_address
 */
class Shops extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shops';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_name'], 'string', 'max' => 50],
            [['shop_address'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'shop_id' => 'Shop ID',
            'shop_name' => 'Shop Name',
            'shop_address' => 'Shop Address',
        ];
    }
}
