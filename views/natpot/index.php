<?php
/**
 * Created by PhpStorm.
 * User: lght
 * Date: 31.01.2019
 * Time: 13:56
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="natpot-page">
    <div class="container1">
        <div class="wrapper">
            <h3>Hi there !</h3>
            <h4>This is NatPot main page!</h4>
            <p class="p_mb16-w100p">
            <span class="span_message_box ">
                <?=Html::a('Выйти',['auth/logout'],['class' => 'span_message_box btn btn-warning'])?>
            </span>
            </p>
        </div>

    </div>
</div>