<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;

class NatpotController extends Controller
{
    public $layout = 'natpot';
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!$session->isActive){
            $session->open();
        }
        if ( !($session->has('isLogined') && $session->get('isLogined') === 1 ) ){
            return $this->redirect(['auth/login']);
        }

        return $this->render('index',[]);
    }
}