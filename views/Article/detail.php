<?php 
$this->registerCssFile('./css/detail.css');
?>
<div class="part">
	<div class="part_head">
		<span><a href="">首页</a></span><div class="arrow_right"></div>
		<span><a href=""><?=$detail->menu->name ?></a></span><div class="arrow_right"></div>
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
			<form id="mycomment">
				<div class="avater">
					<img id="touxiang" src="./img/avater/default.jpg">
				</div>
				
				<div class="submit">
					<textarea id="comment_content" placeholder="请写下您的评论或意见"></textarea>
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
						<li>
							<div class='visitor'></div>
							<span>游客登陆</span>
						</li>
					</ul>
					<input type="button" class="btn btn-default" value="提交" onclick="conSub()">
				</div>	
			</form>
		</div>
	</div>
</div>