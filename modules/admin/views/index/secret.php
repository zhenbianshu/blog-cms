<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div style="padding-right: 50px;">
	<?php $form=ActiveForm::begin(['action'=>Url::current(),'method'=>'post']) ?>
		<?=$form->field($model,'oldPassword')->passwordInput() ?>
		<?=$form->field($model,'password')->passwordInput() ?>
		<?=$form->field($model,'conPassword')->passwordInput() ?>
		<?=Html::submitButton('修改',['class'=>'btn btn-primary']) ?>
	<?php ActiveForm::end() ?>
</div>