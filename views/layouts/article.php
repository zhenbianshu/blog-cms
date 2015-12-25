<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Menu;
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
    <?php
    $menu=new Menu();
    $list=$menu->getMenuList();
    $setting=new Setting();
    $siteName=$setting->getSiteName()->value;
    NavBar::begin([
        'brandLabel' => $siteName,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $list,
    ]);
    NavBar::end();
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>


        <div style="width: 70%;float: left;min-height: 10px;">
            <?= $content ?>
        </div>

        
        <div style="width:30%;float: left;padding-left: 20px;">
            <div class="part">
                <div class="part_head">同类热文</div>
            </div>
            <div class="part">
                <div class="part_head">标签热文</div>
            </div>
        </div>  
    </div>
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
<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>