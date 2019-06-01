<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 16.02.2019
 * Time: 20:36
 */

namespace app\components;


class myCryptFunctions
{
    //
    public static function confirmPassword($hash, $password)
    {
        return crypt($password, $hash) === $hash;
    }

    //
    public static function hashPassword($password,$some_prefix = 'some_prefix',$ssalt='#3ar071')
    {
        $salt = md5(uniqid($some_prefix, true));
        $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
        $ssalt = '$2a$08$';
        return crypt($password, $ssalt . $salt);
    }

    //
    public static function hashPassword2($password, $algo=PASSWORD_BCRYPT)
    {
        return password_hash($password, $algo);
    }
}