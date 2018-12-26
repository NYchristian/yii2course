<?php

namespace app\models;

use app\models\Shops;

use yii\helpers\ArrayHelper;

use yii\base\Model;

use yii\web\UploadedFile;



use Yii;

/**
 * This is the model class for table "items".
 *
 * @property int $item_id
 * @property string $item_name
 * @property string $item_image
 * @property int $shop_id
 *
 * @property Shops $shop
 */


class Items extends \yii\db\ActiveRecord

{
   
    
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'items';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['shop_id'], 'integer'],
            [['item_name'], 'string', 'max' => 50],
            [['item_image'],'required'],
            [['item_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'shop_id']],
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs(Yii::getAlias('@root') .'/uploads/'  . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'item_image' => 'Item Image',
            'shop_id' => 'Shop ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['shop_name' => 'shop_name']);
    }
    public function getShopName() {

        return $this->Shops->Name;

    }
    public function getShopList() { 

        $models = Shops::find()->asArray()->all();

        return ArrayHelper::map($models, 'shop_id', 'shop_name');
    }                                      
         
}
