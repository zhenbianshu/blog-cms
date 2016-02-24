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
$menu=new Menu();
    $list=$menu->getMenuList();
    $setting=new Setting();
    $siteName=$setting->getSiteName()->value;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title.$siteName) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
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
                <div class="part_head">关于</div>
                <div class="contain">
                    <div class="avater_center">
                        <div id="avater">
                            <img src="/img/avater.jpg">
                        </div>
                    </div>
                    <p class="my_desc"><?=$setting->getNickName()->value ?></p>
                    <p class="my_desc"><?=$setting->getDesc()->value ?></p> 
                </div>   
            </div>
            <div class="part">
                <div class="part_head">联系</div>
                <div class="contain">
                    <p class="contact">Email: <a href="mailTo:<?=$setting->getAddress()->value ?>"><?=$setting->getAddress()->value ?></a></p>
                    <p class="contact">GitHub:<a href="https://github.com/zhenbianshu">github.com/zhenbianshu</a></p>
                    <p class="contact">微信服务号：枕边书</p>
                    <p class="contact">您可以<a href="feed">订阅</a>本站，也可以推荐或<strong>分享</strong>给您的朋友。</p>
                </div>   
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
<div id="top">
    <div class="top_up_arrow"></div>
    <a href="#">Top</a>
</div>
<script type="text/javascript">
    window.onload=function(){
        window.onscroll=function()
        {
            if($(document).scrollTop()>300){
                $("#top").css('display','block');
            }
            if($(document).scrollTop()<300){
                $("#top").css('display','none');
            }
        }
    }    
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>