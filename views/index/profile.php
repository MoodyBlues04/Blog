<?php

use app\models\UserData;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html as HelpersHtml;

/**
 * @var app\models\UserData $model
 */

?>
<div class="profile-main">
    <div class="profile-left">
        <div class="profile-picture">
            <img
                class="profile-icon"
                src= <?= Html::encode(UserData::getImgPath())  ?>
                alt=""
                border="0"
            >
            <a href="./upload-img" class="button-link">
                <button 
                    type="button"
                    class="change-icon btn btn-outline-primary"
                >
                    Change icon
                </button>
            </a>
        </div>

        <div class="left-content">
            <a href="./edit" class="button-link">
                <button
                    type="button"
                    class="profile-edit btn btn-outline-primary"
                >
                    Редактировать
                </button>
            </a>
        </div>
    </div>

    <div class="profile-right">
        <?php if (!empty($model->name) && !empty($model->surname)): ?>
            <h2><?= Html::encode($model->name) . ' ' . Html::encode($model->surname)?></h2>
        <?php else: ?>
            <h2>Enter your name and surname</h2>
        <?php endif; ?>
        
        <?php if (!empty($model->introduction)): ?>
            <p><?= Html::encode($model->introduction) ?></p>
        <?php else: ?>
            <h2>Enter some introduction here</h2>
        <?php endif; ?>
        
        <div>some another information maybe (not users')</div>
    </div>
</div>

<div class="profile-content">
    <?php foreach($articles as $article): ?>
        <div class="profile-article">
            <div class="profile-article-head">
                <div class="profile-article-header">
                    <?= Html::encode($article->header) ?>
                </div>

                <div class="profile-article-date">
                    <?= Html::encode($article->created_at) ?>
                </div>
            </div>

            <div class="profile-article-content">
                <?= Html::encode($article->content) ?>
            </div>

            <div class="profile-article-tags">
                <?= Html::encode($article->tags) ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>