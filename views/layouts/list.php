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
    $menu=new Menu();
    $list=$menu->getMenuList();
    $setting=new Setting();
    $tags=$menu->getTags();
    $all=0;
    foreach ($tags as $tag) {
        $all+=$tag['num'];
    }
    $average=18;
    if(count($tag)!=0){
       $average=$all/count($tags); 
    }  
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
                            <a href="<?=Url::to(['article/detail']).'?id='.$hot['id'] ?>"><?=$hot['title']?></a>
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
                <div class="contain">
                     <?php foreach ($tags as $tag): ?>
                        <span class='hot_tag' style="font-size: 
                        <?php 
                        $font=$tag['num']/$average*18;
                        if($font>30)$font=30;
                        if($font<14)$font=14;
                        echo $font; 
                        ?>px;">
                        <a onmouseover="this.style.color='orange'"
                            onmouseout="this.style.color='#222'"
                         style="color: #222;" href="<?=Url::to(['blog/tag']).'?id='.$tag['id'] ?>"><?=$tag['name'] ?></a> </span>
                    <?php endforeach ?>   
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
