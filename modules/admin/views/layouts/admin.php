<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
$this->registerCssFile('./css/backen.css');
$action = Yii::$app->controller->action->id;
$menu=array('add'=>'添加博文','show'=>'管理博文','list'=>'管理评论','menu'=>'管理导航','info'=>'管理信息','index'=>'欢迎界面','secret'=>'修改密码','msg'=>'管理留言');
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
	<div class="menu_list" >
			<span class="index">SQBlog</span>
			<span class="words_main">MAIN</span>
			<ul class="main">
				<li <?php if($action=='add')echo "class='chosen'";  ?>><a href="<?=Url::to(['article/add']) ?>">添加博文</a></li>
				<li <?php if($action=='show')echo "class='chosen'";  ?>><a href="<?=Url::to(['article/show']) ?>">管理博文</a></li>
				<li <?php if($action=='list')echo "class='chosen'";  ?>><a href="<?=Url::to(['comment/list']) ?>">管理评论</a></li>
				<li <?php if($action=='msg')echo "class='chosen'";  ?>><a href="<?=Url::to(['message/msg']) ?>">管理留言</a></li>
				<li <?php if($action=='menu')echo "class='chosen'";  ?>><a href="<?=Url::to(['nav/menu']) ?>">管理导航</a></li>
				<li <?php if($action=='info')echo "class='chosen'";  ?>><a href="<?=Url::to(['setting/info']) ?>">管理信息</a></li>
			</ul>
			<span class="words_main">PROFILE</span>
			<ul class="main">
				<li <?php if($action=='index')echo "class='chosen'"; ?>><a href="<?=Url::to(['index/index']) ?>">欢迎界面</a></li>
				<li <?php if($action=='secret')echo "class='chosen'";  ?>><a href="<?=Url::to(['index/secret']) ?>">修改密码</a></li>
				<li <?php if($action=='logout')echo "class='chosen'";  ?>><a href="<?=Url::to(['log/logout']) ?>">退出登陆</a></li>
			</ul>

			<p class="announce">&copy; 枕边书博客CMS系统 <?= date('Y') ?></p>
	</div>
	<div style="width:82%;height: 100%;float: left;vertical-align: top;">
		<div style="line-height: 30px; font-size: 30px;font-weight: 700; height: 15%;width:100%;padding-top: 30px;padding-left: 40px;">
			<?=isset($menu[$action]) ? $menu[$action] : "错误页面" ?>
		</div>
		<div style="background: #fafafa;height: 85%;width: 100%;padding-left: 40px;padding-top: 20px;">
			<?=$content?>
		</div>
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>