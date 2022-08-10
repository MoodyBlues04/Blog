<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\models\UserData;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" href="https://unpkg.com/flexboxgrid2@7.2.1/flexboxgrid2.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <header>
            <div>
            <?php
                $a = 1; 
                // search
                // $model = User::find()
                //     ->where(['status' => User::STATUS_ACTIVE])
                //     ->all();
                // $form = ActiveForm::begin();
                // $data = [2 => 'widget', 3 => 'dropDownList', 4 => 'yii2'];
                
                // echo Select2::widget([ 'name' => 'title', 
                //     'data' => $data, 
                //     'options' => ['placeholder' => 'Пожалуйста, выберите ...'] 
                // ]);
                // // echo $form->field($model, 'title')->widget(Select2::classname(), [  
                // //     'data' => $data, 
                // //     // 'options' => ['placeholder' => 'Пожалуйста, выберите ...'], 
                // // ]);
                // ActiveForm::end();
            ?>
            </div>
            <div class="user"> 
                
                <div class="dropdown">
                    <button
                        class="btn btn-link dropdown-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria-expanded="false"
                    >
                    </button>

                    <?php if (!Yii::$app->user->isGuest): ?>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./profile">Профиль</a>
                            <a class="dropdown-item" href="./settings">Настройки</a>
                            <a class="dropdown-item" href="./log-out">Выйти</a>
                        </div>
                    <?php else: ?>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="./login">Log In</a>
                            <a class="dropdown-item" href="./signup">Sign Up</a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="username">
                <?php
                    if (isset(Yii::$app->user->identity->username)) {
                        echo Yii::$app->user->identity->username;
                    } else {
                        echo "Guest";
                    }
                ?>
                </div>

                <img
					class="user-icon"
					src= <?= Html::encode(UserData::getImgPath()) ?>
					alt=""
					border="0"
				>
            </div>
        </header>
        <main>
            <div class="tools">
                <!-- <a href="../index/index" class="tool">main</a> -->
                <a href="../index/index"><img
                    src="https://i.ibb.co/hHz1sZ4/home.jpg"
                    style="width:40px; height: 40px"
                    alt="home"
                    border="0">
                </a>
                <a href="../article/create" class="tool">publish</a>
                <a href="../article/search" class="tool">search</a>
                <a href="#4" class="tool">feature 4</a>
                <a href="#5" class="tool">feature 5</a>
            </div>
            <div class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
        <footer>
            some footer text
        </footer>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>