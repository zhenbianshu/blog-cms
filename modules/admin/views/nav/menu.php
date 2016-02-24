<?php 
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	$menus=array();
?>
<style type="text/css">
	.unit{width: auto;height: 20%;float: left;display: inline-block;margin-top: 20px;margin-left: 40px; text-align: center;}
	.add{position: absolute;bottom: 30px;right: 50px;width: 75%;border: 1px solid orange; padding: 10px;padding-bottom: 0px;}
	.form-group{display: inline-block;width: 30%;}
	.control-label{width: 60px;display: inline-block;}
	.form-control{width: 150px;display: inline-block;}
	.help-block{display: inline-block;}
</style>
<?php foreach ($firsts as $first): ?>
	<?php 
		$tmp=array();
		$i=0; 
		$menus[$first->id]=$first->name;
		foreach ($seconds as  $second)
		{
			if($second->pmenu==$first['id'])
			{
				$tmp[$i]['id']=$second->id;
				$tmp[$i]['name']=$second->name;
			}
			$i++;
		} 
	?>
	<div class="">
		<table class="table table-bordered unit">
			<tr>
				<td colspan="<?=count($tmp) ?>"><?=$first->name ?></td>
			</tr>
			<tr>
				<td colspan="<?=count($tmp) ?>"><a href="<?=Url::to(['nav/del']).'?id='.$first->id ?>" onclick="return confirm('删除会将其子菜单也删除，是否继续？');">删除</a></td>
			</tr>
			<tr>
				<?php foreach ($tmp as $tmp_second): ?>
					
					<td><?=$tmp_second['name'] ?></td>
					
				<?php endforeach ?>
			</tr>
			<tr>
				<?php foreach ($tmp as $tmp_second): ?>	
					<td>
						<a href="<?=Url::to(['nav/del']).'?id='.$tmp_second['id'] ?>" onclick="return confirm('删除后其类下文章也会被删除，是否继续？');">删除</a>
					</td>
					
				<?php endforeach ?>
			</tr>
									
		</table>		
	</div>
<?php endforeach ?>

<div class="add">
	<?php $form=ActiveForm::begin(['action'=>['nav/add'],'method'=>'post']) ?>
		<?=$form->field($model,'pmenu')->dropDownList($menus, ['prompt'=>'总分类']) ?>
		<?=$form->field($model,'name') ?>
		<?=$form->field($model,'route') ?>
		<?= Html::submitButton('添加',['class'=>'btn btn-primary']) ?>
	<?php ActiveForm::end() ?>
</div>