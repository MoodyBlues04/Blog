<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

/**
 * @var Article $article
 */
?>
<div class="card article-container" style="margin-top: 20px">
    <div class="card-body">
        <div class="article-author">
            <div class="card-subtitle article-user">
                <?php
                    $userData = $article->user->userData;
                    echo Html::encode("$userData->name $userData->surname")
                ?>
            </div>

            <div class="card-subtitle mb-2 text-muted article-time">
                <?= Html::encode($article->created_at) ?>
            </div>
        </div>

        <div class="card-title article-header">
            <?= Html::encode($article->header) ?>
        </div>

        <div class="card-text article-content">
            <?= Html::encode($article->content) ?>
        </div>

        <!-- переделать в ссылки с поиском или просто в текст хотя бы -->
        <?php if (!empty($article->tags)): ?>
                <div class="profile-article-tags" style="margin-top: 5px">
                    <?php $tags = json_decode($article->tags, true);
                        foreach ($tags as $tag):
                    ?>
                        <a href=<?= Url::to(['article/search', 'tag' => '#' . $tag]) ?> class="tag">
                            <?= Html::encode("#$tag") ?>
                        </a>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>
    </div>
</div>
