<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 16.02.2019
 * Time: 14:56
 */

namespace app\models;


use yii\base\Model;

class UserRegistration extends Model
{
    public $email;
    public $password;
    public $password_re;
    public $captcha;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password', 'password_re'], 'required'],
            ['password_re', 'compare', 'compareAttribute' => 'password'],

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
            'password' => 'Пароль',
            'password_re' => 'Повтор пароля',
            'captcha' => 'Капча'
        ];
    }
}