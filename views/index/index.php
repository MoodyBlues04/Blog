<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Articles</h1>
<ul>
<?php foreach ($articles as $article): ?>
    <div class="article">
        <div class="article-author">
            <div class="article-user">
                <?php
                    $userData = $article->user->userData;
                    echo Html::encode("$userData->name $userData->surname")
                ?>
            </div>
            <div class="article-time">
                <?= Html::encode("$article->created_at") ?>
            </div>
            
        </div>
        <div class="article-header">
            <?= Html::encode("$article->header") ?>
        </div>
        <div class="article-content">
            <?= Html::encode("$article->content") ?>
        </div>
        <div class="article-tags">
            <!-- переделать в ссылки с поиском или просто в текст хотя бы -->
            <?= Html::encode("$article->tags") ?>
        </div>
    </div>
<?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>