<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Menu;

$menus=(new Menu())->getMenuOption();
?>
<style type="text/css">
	.form-control{display: inline-block;width: 50%;}
	.control-label{display: inline-block;}
	.help-block{display: inline-block;}
	.form-group{display: inline-block;width: 30%; }
	.textarea_limit{display: inline-block;width: 75%;}
	.file_limit{display: inline-block;width: 50%;float: right;margin-right: 120px;}
	.field-article-abstract{display: inline-block;width: 100%;height: 50px;}
	.note{color: #999;font-size: 13px;}
</style>
<?php
$form=ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'action'=>['article/add'],'method'=>'post']);
?>
<div>
	<?=$form->field($model,'title')?>
	<?=$form->field($model,'author')?>
	<?=$form->field($model,'address')?>
</div>
<div>
	<?=$form->field($model,'pic')->fileInput($options = ['class' => 'file_limit']) ?>
	<?=$form->field($model,'description')?>
	<?=$form->field($model,'class')->dropDownList($menus) ?>
</div>
<div style="width: 96%;">
	<script id="container" name="content" type="text/plain"></script>
</div>
    <script type="text/javascript" src="/ume/ueditor.config.js"></script>
    <script type="text/javascript" src="/ume/ueditor.all.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
    </script>
<div style="margin-top: 10px;">
	<?=$form->field($model,'abstract')->textarea($options=['class'=>'textarea_limit form-control','rows'=>2]) ?>
	<?=$form->field($tag,'name') ?> <span class="note">最多三个，用,分隔</span>
	<div style="display: inline-block;margin-left: 300px;vertical-align: bottom;">
		<?=Html::submitButton('完成',['class'=>'btn my_btn btn-primary']) ?>
	</div>
</div>

<?php ActiveForm::end() ?>
        

