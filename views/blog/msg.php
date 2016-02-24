<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use app\models\Visitor;
$visitor=new Visitor();
$this->title='留言板'.'--';
?>
<script type="text/javascript">
	var nameAddress="<?=Url::to(['log/name']) ?>"
</script>
<?php $this->registerCssFile('/css/msg.css'); ?>
<div class="part">
	<div class="part_head">
	欢迎光临
	</div>
	<div class="welcome">
		<p>欢迎光临我的博客站点，一开始建立这个站点是希望有个属于自己的站点，可以“为所欲为”，也希望把自己的文章，自己喜欢的文章有个自己中意的存放地方。</p>
		<p>本站CMS是由本人用YII2框架搭建，页面也是由本人自写的CSS和JS，还有些功能等待完善，欢迎分享使用。</p>
		<p>另外本人才疏学浅，站点难免有错误或BUG，如有发现，万望指正。</p>
	</div>
</div>
<div class="part">
	<div class="part_head">
	写留言
	</div>
	<div class="content down">
		<div class="write_comment">
			<form id="mycomment" method="post" action="<?=Url::to(['blog/msg']) ?>" >
				<div class="avater">
					<img id="touxiang" src="<?php if($avater=Yii::$app->session->get('user_avater')) echo $avater;else echo '/img/avater/default.jpg'  ?>">
				</div>				
				<div class="submit">
					<textarea id="comment_content" name="content" placeholder="欢迎留言"></textarea>
					<?php if(!Yii::$app->session->get('valid_user')): ?>
					<ul>
						<li>
							<div class='weibo'></div>
							<span>微博登陆</span>
						</li>
						<li>
							<div class='qq'></div>
							<span>QQ登陆</span>
						</li>
						<li>
							<div class='baidu'></div>
							<span>百度登陆</span>
						</li>
						<li onclick="logVisitor()">
							<div class='visitor'></div>
							<span>游客登陆</span>
						</li>
					</ul>
					<?php else: ?>
					<div style="display: inline-block;margin-top: 15px;">
						<span style="font-size: 14px;color: #bbb;">正在登陆：</span><span style="font-size: 15px;color: #222;"><?=Yii::$app->session->get('valid_user') ?></span>
					</div>
					<div style="display: inline-block; margin-left: 20px;"><a href="<?=Url::to(['log/logout'])?>">退出</a> </div>
						
					<input type="button" class="btn btn-default" value="提交" onclick="conSub()">
					<?php endif ?>
				</div>	
			</form>
		</div>
	</div>
</div>
<div class="part">
	<div class="part_head">
		留言(<?=count($msgs) ?>)
	</div>
	<div class="content">
		<?php foreach ($msgs as $msg): ?>
			<div class="msg">
				<div class="avater">
					<img src="<?=$msg->avater ?>">
				</div>
				<div class="msg_detail">
					<span class="author"><a href="#" onclick="return false;"><?=$msg->author ?></a></span>
					<span class="pubtime"><?=date('Y-m-d',$msg->pubtime) ?></span>
					<p class="msg_content"><?=$msg->content ?></p>
				</div>
			</div>
		<?php endforeach ?>
	</div>	
</div>
<div class="visitor_form" id="visitor_form">
	<div class="main_frame">
		<div class="form_title">游客登陆 <div class="entrance" onclick="closeLog()">X</div></div>
		<div id="mask">
			<?php $form=ActiveForm::begin(['action'=>Url::to(['log/login']),'method'=>'post']) ?>
			<?=$form->field($visitor,'name') ?>
			<?=$form->field($visitor,'verify')->widget(Captcha::className(),
		        ['captchaAction'=>'log/captcha',
		            'imageOptions'=>
		            ['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer']
		        ]) ?>
			<?=Html::submitButton('登陆',['class'=>'btn btn-primary']) ?>
			<?php ActiveForm::end() ?>
		</div>
	</div>
	
</div>
<?php $this->registerJsFile('/js/login.js'); ?>