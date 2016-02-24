<?php 
use app\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;

$menus=(new Menu())->getMenuOption();
?>
<form id="choose" action="<?=Url::to(['article/show']) ?>" method='post' style="margin-bottom: 5px;">
	<span>请选择分类：</span>
	<select name='id' class="form-control" style="width: 100px;display: inline-block;" onchange="document.forms[0].submit()">
		<option value="">全部</option>
		<?php foreach ($menus as $key => $value): ?>
			<option  value="<?=$key ?>" 
			<?php if($chosen==$key)echo 'selected'; ?> >
			<?=$value ?></option>
		<?php endforeach ?>	
	</select>
</form>
<table class="table table-bordered table-hover">
<tr><th>标题</th><th>作者</th><th>简述</th><th colspan="3">操作</th></tr>
	<?php foreach ($articles as $article): ?>
		<tr>
			<td><?=$article->title ?></td>
			<td><?=$article->author ?></td>
			<td><?=$article->description ?></td>
			<td><a href="<?=Url::to(['article/del']).'?id='.$article->id ?>"  onclick="return confirm('确认要删除吗？');">删除</a> </td>
			<td><a href="<?=Url::to(['article/upd']).'?id='.$article->id ?>">修改</a> </td>
			<td><a href="<?=Url::to(['article/top']).'?id='.$article->id ?>"><?php if($article->top==1)echo '取消置顶';else echo '置顶'; ?></a> </td>
		</tr>
	<?php endforeach ?>
</table>
<div style="text-align: center;position: fixed;bottom: 0px;left: 500px;">
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