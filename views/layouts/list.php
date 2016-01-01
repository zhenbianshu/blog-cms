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
use yii\helpers\Url;

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


        <div style="width: 70%;float: left;">
            <?= $content ?>
        </div>
        <div style="width:30%;float: left;padding-left: 20px;">
            <div class="part">
                <div class="part_head">关于</div>
                <div class="contain">
                    <div id="avater">
                        <img src="./img/avater.jpg">
                    </div>
                    <div class="desc">
                        <p><?=$setting->getNickName()->value ?></p>
                        <div><?=$setting->getDesc()->value ?></div> 
                    </div>
                    <div class="contact">
                        <p>Email: <a href="mailTo:<?=$setting->getAddress()->value ?>"><?=$setting->getAddress()->value ?></a></p>
                        <p>您可以<a href="feed">订阅</a>本站，也可以推荐或<a href="#">分享</a>给您的朋友。</p>
                    </div>
                </div>   
            </div>
            <div class="part">
                <div class="part_head">最热文章</div>
                <div class="contain">
                   <?php
                        $article=new Article();
                        $hots=$article->getHot();
                        foreach ($hots as $hot)
                        {                       
                    ?>
                    <p class="hot">
                        <span class="hot_title">
                            <a href="<?=Url::to(['article/detail']).'&id='.$hot['id'] ?>"><?=$hot['title']?></a>
                        </span>
                        <span class="hot_view">
                            <?=$hot['readnum']?>views
                        </span> 
                    </p>
                    
                    <?php
                        }
                    ?>     
                </div>
                
            </div>
            <div class="part">
                <div class="part_head">热门标签</div>     
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
