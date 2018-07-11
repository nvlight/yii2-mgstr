<?php

namespace app\modules\str\models;

use Yii;
use snewer\images\models\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "str_material".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $price2
 * @property string $img
 */
class Material extends \yii\db\ActiveRecord
{
    public $img;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'str_material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price','short_desc'], 'required'],
            [['description','short_desc'], 'string'],
            //[ ['image_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 101],
            [['short_desc'], 'string' , 'max' => '207'],
            [['price2'], 'string', 'max' => 59],
            //[['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg']
        ];
    }

    //
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id'])->with();
    }

    //
    public function upload()
    {
        //echo 'this.img: ' . $this->img; die;
        $rs = $this->img->saveAs(Yii::$app->params['img_uploads']
            . $this->img->baseName . '.'
            . $this->img->extension);
        return ($rs !== null) ? true : false;

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'short_desc' => 'Спецификация',
            'description' => 'Описание',
            'price' => 'Цена',
            'price2' => 'История цен',
            'image_id' => 'Изображение',
            'img' => 'Картинка'
        ];
    }
}
