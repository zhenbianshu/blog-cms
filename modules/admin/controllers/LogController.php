<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\LoginForm;

class LogController extends Controller
{
	public $layout=false;

    public function actionIndex()
    {
        $model = new LoginForm();
        return $this->render('login', ['model' => $model]);
       
    }
    public function actionLogin()
    {
    	$model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        	echo "hello";
        }
    }
}