<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerCssFile('./css/backen.css')
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('SQBlog-登陆') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div style="width: 600px;margin: 50px auto;border: 1px solid #c3c3c3;border-radius: 10px;box-shadow: 5px 5px 5px rgba(200,200,200,0.5);">
<div style="width: 100%;height: 30px;background:#f8f8f8 ;border-radius: 9px 9px 0 0 ;line-height: 30px;font-weight: 600;padding-left: 20px;">SQBlog登陆</div>
<div style="padding: 20px">
    <?php $form = ActiveForm::begin([
        'action' => ['log/login'],
        'method'=>'post'
        ]); ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(),
        ['captchaAction'=>'log/captcha',
            'imageOptions'=>
            ['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer']
        ]) ?>
        <div class="form-group">
            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
    
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
