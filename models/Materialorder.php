<?php

namespace app\modules\str\models;

use Yii;

/**
 * This is the model class for table "str_material_order".
 *
 * @property int $id
 * @property int $id_project
 * @property int $id_room
 * @property int $id_material
 * @property int $count
 * @property int $price
 * @property string $note
 */
class Materialorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'str_material_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'id_room', 'id_material', 'count', ], 'required'],
            [['id_project', 'id_room', 'id_material', 'count', 'price'], 'integer'],
            [['note'], 'string', 'max' => 111],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'Проект',
            'id_room' => 'Комната',
            'id_material' => 'Материал',
            'count' => 'Количество',
            'price' => 'Цена',
            'summ' => 'Сумма',
            'note' => 'Примечание',
        ];
    }

    //
    public function getMaterial(){
        return $this->hasOne(Material::className(),['id' => 'id_material']);
    }
}
