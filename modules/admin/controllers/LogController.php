<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\modules\admin\models\LoginForm;

class LogController extends Controller
{
	public $layout=false;

	public function actions() {
        return [
            'captcha' =>  [
                'class' => 'yii\captcha\CaptchaAction',
                'height' => 50,
                'width' => 80,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new LoginForm();
        return $this->render('login', ['model' => $model]);
       
    }
    public function actionLogin()
    {
    	$model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
        	if($model->checkUser()){
        		$session = Yii::$app->session;
        		$session->set('valid_admin',$model->username);
        		$this->redirect(Url::to(['index/index']));
        	}
        }
    }
}