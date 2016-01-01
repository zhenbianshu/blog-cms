<?php 
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
$this->registerCssFile('./css/detail.css');
?>
<script type="text/javascript">
	var nameAddress="<?=Url::to(['log/name']) ?>"
</script>
<div class="part">
	<div class="part_head">
		<span><a href="<?=Yii::$app->request->hostinfo ?>">首页</a></span><div class="arrow_right"></div>
		<span><a href="<?=Url::to(['blog/index']).'&id='.$detail->menu->name ?>"><?=$detail->menu->name ?></a></span><div class="arrow_right"></div>
		<span><a href=""><?=$detail->title ?></a></span>
	</div>
	<div class="contain">
		<div class="detail_title">
			<span>作者：<?=$detail->author ?></span>
			<span>日期：<?=date('Y-m-d',$detail->pubtime) ?></span>
			<span>感谢或参考<a href="">原文</a></span><br>
			<span>简评：<?=$detail->description ?></span>
			<span>已有<?=$detail->readnum ?>次阅读</span>
		</div>
		<div class="detail">
			<?=$detail->content ?>
		</div>
		<div class="reprint">
			注意：转载随意，请带上原文地址。
		</div>	
		<div class="share">
			<div class="share_title">如果您认为这篇文章值得更多人阅读，欢迎使用下面的分享功能。</div>
			<div class="jiathis_style_24x24">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_weixin"></a>
				<a class="jiathis_button_renren"></a>
				<a class="jiathis_button_fav"></a>
				<a class="jiathis_button_email"></a>
				<a class="jiathis_button_cqq"></a>
				<a class="jiathis_button_t163"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
			</div>
		</div>
		<div class="comments">
			<?php
			if(empty($comments))
			{
			 echo "<span class='nocomment'>暂时还没有评论，快来抢沙发吧~</span>";
			}else
			{$i=0;?>
			<div class="comments_head">评论(<?=count($comments)?>)</div>
			<?php 
			foreach ($comments as $comment): $i++;?>
			<div class="comment">
				<div class="user_avater"><img src="<?=$comment['avater']?>"></div>
				<div class="c_content">
					<div class="c_title">
						<a href="#" onclick="return false;"><?=$comment['author'] ?></a>
						<?=date('Y-m-d',$comment['pubtime']) ?>
					</div>
					<div class="c_detail">
						<p><?=$comment['content']?></p>
					</div>
					<div class="floor"><?=$i ?>楼</div>
				</div>
			</div>
				
			<?php endforeach;} ?>
		</div>
		<div class="write_comment">
			<form id="mycomment" method="post" action="<?=Url::to(['blog/comment']) ?>" >
				<div class="avater">
					<img id="touxiang" src="<?php if($avater=Yii::$app->session->get('user_avater')) echo $avater;else echo './img/avater/default.jpg'  ?>">
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
<?php $this->registerJsFile('./js/login.js'); ?>