<?php 
use yii\helpers\ZbsFunction;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<table class="table table-hover table-border">
	<tr><th>时间</th><th>ip</th><th>昵称</th><th>文章</th><th>内容</th><th>操作</th></tr>
	<?php foreach ($comments as $comment): ?>
		<tr>
			<td><?=date('Y-m-d',$comment->pubtime) ?></td>
			<td><?=$comment->ip ?></td>
			<td><?=$comment->author ?></td>
			<td><a href="<?=Url::to(['//article/detail']).'?id='.$comment->article_id; ?>"><?=$comment->article->title ?></a> </td>
			<td><?=ZbsFunction::str_trunck($comment->content,30) ?></td>
			<td><a href="<?=Url::to(['comment/del']).'?id='.$comment->id ?>" onclick="return confirm('确认要删除吗？');">删除</a></td>
		</tr>	
	<?php endforeach ?>
</table>
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