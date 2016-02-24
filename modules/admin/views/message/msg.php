<?php 
use yii\helpers\ZbsFunction;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<table class="table table-hover table-border">
	<tr><th>时间</th><th>ip</th><th>昵称</th><th>内容</th><th>操作</th></tr>
	<?php foreach ($msgs as $msg): ?>
		<tr>
			<td><?=date('Y-m-d',$msg->pubtime) ?></td>
			<td><?=$msg->ip ?></td>
			<td><?=$msg->author ?></td>
			<td><?=ZbsFunction::str_trunck($msg->content,30) ?></td>
			<td><a href="<?=Url::to(['message/del']).'?id='.$msg->id ?>" onclick="return confirm('确认要删除吗？');">删除</a></td>
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