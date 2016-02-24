<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p style="margin-bottom: 20px;">请填写您要修改的项目：</p>
<div style="padding-right: 50px;">
	<?php $form=ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'action'=>Url::to(['setting/upd']),'method'=>'post']);?>
		<?=$form->field($model,'site_name') ?>
		<?=$form->field($model,'nick_name') ?>
		<?=$form->field($model,'desc') ?>
		<?=$form->field($model,'address') ?>
		<label class="control-label">站长头像</label>
		<input type="file" name="avater" style="margin-top: 5px;margin-bottom: 15px;">
		<?=Html::submitButton('修改',['class'=>'btn btn-primary']) ?>
	<?php ActiveForm::end() ?>
</div>
	