<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property int $i_group
 * @property string $restore_date
 * @property int $restore_count
 * @property string $restore_hash
 * @property string $create_date
 * @property string $update_last_date
 */
class StrUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['i_group', 'restore_flag'], 'integer'],
            [['restore_date', 'create_date', 'update_last_date'], 'safe'],
            [['email', 'password', 'name', 'restore_hash'], 'string', 'max' => 61],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Пароль',
            'name' => 'Name',
            'i_group' => 'I Group',
            'restore_date' => 'Restore Date',
            'restore_flag' => 'Restore flag',
            'restore_hash' => 'Restore Hash',
            'create_date' => 'Create Date',
            'update_last_date' => 'Update Last Date',
        ];
    }
}
