<?php 
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\ZbsFunction;

$this->registerCssFile('./css/list.css');

foreach ($res as $article):
?>
	<div class="article">
		<div class="article_head">
			<span class="cg"><?=$article->menu->name ?></span>
			<a href="<?php echo Url::to(['article/detail'])."&id=".$article->id ?>" ><?= $article->title ?></a>	
		</div>
		<div class="img_box">
			<img src="<?php if($article->pic)echo $article->pic;else echo "./img/list/".rand(1,20).".jpg"; ?>">
		</div>
		<div class="content">
			<div class="first_line">
				<div class="label_author"></div>
				<a class="author" href="<?= $article->address ?>"><?=$article->author ?></a>
				<div class="label_time"></div>
				<span class="pubtime"><?= date('Y-m-d',$article->pubtime)?></span>
			</div>
			<div class="second_line">
				<?php foreach ($tags as $tag): 
					if($tag['a_id']==$article->id):
				?>
					<a class='tag' href="<?php echo Url::to(['blog/tag']).'&id='.$tag['g_id']; ?>" ><?=$tag['name'] ?></a>
				<?php 
					endif;
				endforeach; ?>
				<span class="desc"><?=$article->description ?></span>
			</div>
			<p class="abstract"><?=ZbsFunction::str_trunck($article->abstract,360) ?></p>
			<div class="look_all">
				<a href="<?php echo Url::to(['article/detail']).'&id='.$article->id; ?>"> 查看全文 >></a>
			</div>
			<div class="read"><?=$article->readnum ?> views</div>
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
