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
$this->registerCssFile('./css/backen.css')
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
				<li><a href="">添加博文</a></li>
				<li><a href="">管理博文</a></li>
				<li><a href="">管理评论</a></li>
				<li><a href="">管理导航</a></li>
				<li><a href="">管理信息</a></li>
			</ul>
			<span class="words_main">PROFILE</span>
			<ul class="main">
				<li><a href="">内容概况</a></li>
				<li><a href="">修改密码</a></li>
				<li><a href="">退出登陆</a></li>
			</ul>

			<p class="announce">&copy; 枕边书博客CMS系统 <?= date('Y') ?></p>
	</div>
	<div style="width=82%;float: left;vertical-align: top;">
		<?=$content?>
	</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
