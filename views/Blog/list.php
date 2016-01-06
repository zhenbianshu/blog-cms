<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\ZbsFunction;

$this->registerCssFile('/css/list.css');
if(isset($className))
{
	$this->title=$className.'--';
}
foreach ($tops as $top):
?>
	<div class="article">
		<div class="article_head">
			<span class="cg">[顶]</span>
			<span class='description'><?=$top->description ?></span>
		</div>
		<div class="article_content">
			<div class="content_img">
				<img src="<?=$top->pic ?>">
			</div>
			<div class="content_right">
				<div class="first_line">
					<div class="label_author"></div>
					<a href="<?php echo Url::to(['article/detail'])."?id=".$top->id ?>" ><?= $top->title ?></a>
					<div class="label_time"></div>
					<span class="pubtime"><?= date('Y-m-d',$top->pubtime)?></span>
				</div>
				<div class="second_line">
					<?=$top->author ?>
					<span class="desc">
						<?php foreach ($tags as $tag): 
							if($tag['a_id']==$top->id):
						?>
							<a class='tag' href="<?php echo Url::to(['blog/tag']).'?id='.$tag['g_id']; ?>" ><?=$tag['name'] ?></a>
						<?php 
							endif;
						endforeach; ?>
					</span>
				</div>
				<p class="abstract"><?=ZbsFunction::str_trunck($top->abstract,360) ?></p>
				<div class="look_all">
					<a href="<?php echo Url::to(['article/detail']).'?id='.$top->id; ?>"> 查看全文 >></a>
				</div>
				<div class="read"><?=$top->readnum ?> views</div>
			</div>
		</div>
	</div>	
<?php endforeach;
foreach ($res as $article):
?>
	<div class="article">
		<div class="article_head">
			<span class="cg"><?=$article->menu->name ?></span>
			<span class='description'><?=$article->description ?></span>
		</div>
		<div class="article_content">
			<div class="content_img">
				<img src="<?=$article->pic ?>">
			</div>
			<div class="content_right">
				<div class="first_line">
					<div class="label_author"></div>
					<a href="<?php echo Url::to(['article/detail'])."?id=".$article->id ?>" ><?= $article->title ?></a>
					<div class="label_time"></div>
					<span class="pubtime"><?= date('Y-m-d',$article->pubtime)?></span>
				</div>
				<div class="second_line">
					<?=$article->author ?>
					<span class="desc">
						<?php foreach ($tags as $tag): 
							if($tag['a_id']==$article->id):
						?>
							<a class='tag' href="<?php echo Url::to(['blog/tag']).'?id='.$tag['g_id']; ?>" ><?=$tag['name'] ?></a>
						<?php 
							endif;
						endforeach; ?>
					</span>
				</div>
				<p class="abstract"><?=ZbsFunction::str_trunck($article->abstract,360) ?></p>
				<div class="look_all">
					<a href="<?php echo Url::to(['article/detail']).'?id='.$article->id; ?>"> 查看全文 >></a>
				</div>
				<div class="read"><?=$article->readnum ?> views</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>

<div style="text-align: center">
	<?php
		echo LinkPager::widget([
		    'pagination' => $page,
		    'firstPageLabel'=>"首页",
		    'prevPageLabel'=>'上一页',
		    'nextPageLabel'=>'下一页',
		    'lastPageLabel'=>'尾页',
			]);
	?>
</div>
