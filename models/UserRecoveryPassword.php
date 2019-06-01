<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 16.02.2019
 * Time: 14:56
 */

namespace app\models;


use yii\base\Model;

class UserRecoveryPassword extends Model
{
    public $email;
    public $captcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email'], 'required'],

            [ ['captcha'], 'required'],
            [ ['captcha'], 'captcha', 'message' => 'Необходимо заполнить капчу'],

            [ ['email'], 'email', 'message' => 'Например, email@example.com'],
            //['password', 'validatePassword'],
        ];
    }

    //
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'captcha' => 'Капча'
        ];
    }
}