<?php

use yii\helpers\Html;

/* @var $user app\models\Users */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['index/confirm', 'token' => $user->confirm_token]);
?>
<div class="">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>Follow the link below to confirm your email:</p>

    <p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
</div>