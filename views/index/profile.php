<?php

use app\models\UserData;
use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\Url;

/**
 * @var app\models\UserData $model
 */
/**
 * @var yii\db\ActiveQuery $articles
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
            <a href=<?= Url::to(['index/upload-img'])?> class="button-link">
                <button 
                    type="button"
                    class="change-icon btn btn-outline-primary"
                >
                    Change icon
                </button>
            </a>
        </div>

        <div class="left-content">
            <a href=<?= Url::to(['index/edit'])?> class="button-link">
                <button
                    type="button"
                    class="profile-edit btn btn-outline-primary"
                >
                    Edit
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
        
    </div>
</div>

<div class="profile-content">
    <?php foreach($articles as $article): ?>
        <a href= <?= Url::to(['/article/show', 'id' => $article->id]) ?> class="card profile-article">
                <div class="card-subtitle profile-article-head">
                    <div class="profile-article-header">
                        <?= Html::encode($article->header) ?>
                    </div>

                    <div class="card-subtitle text-muted mb-2 profile-article-date">
                        <?= Html::encode($article->created_at) ?>
                    </div>
                </div>

                <div class="card-text profile-article-content">
                    <?php 
                        if (mb_strlen($article->content, 'utf-8') > 100) {
                            echo Html::encode(mb_substr($article->content, 0, 100) . '...');
                        } else {
                            echo Html::encode($article->content);
                        }
                    ?>
                </div>

                <!-- переделать в ссылки с поиском или просто в текст хотя бы -->
                <?php if (!empty($article->tags)): ?>
                    <div class="profile-article-tags">
                        <?php $tags = json_decode($article->tags, true);
                            foreach ($tags as $tag):
                        ?>
                            <div class="tag">
                                <?= Html::encode("#$tag") ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div style="width: 100%; height: 24px"> </div>
                <?php endif; ?>
        </a>
    <?php endforeach; ?>

    <?= LinkPager::widget([
        'pagination' => $pagination,
        'options' => [
            'class' => 'pagination',
            'maxButtonCount' => 3,
        ]
    ]) ?>
</div>