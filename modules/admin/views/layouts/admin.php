<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Menu;
use app\models\Article;
use app\models\Setting;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
<div style="height: 60px;background: #222222;line-height: 60px;font-size: 32px;font-family: '微软雅黑';font-weight: 600;color: #9D9D9D;padding-left: 50px;" >MDBlog</div>
<?=$content?>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; 枕边书博客CMS系统 <?= date('Y') ?></p>
        <p class="pull-right">枕边书</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
