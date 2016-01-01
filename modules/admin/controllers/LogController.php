<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\modules\admin\models\Admin;

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
        $model = new Admin();
        return $this->render('login', ['model' => $model]);
       
    }
    public function actionLogin()
    {
    	$model = new Admin();
        if ($model->load(Yii::$app->request->post()))
        {
        	if($model->checkUser()){
        		$session = Yii::$app->session;
        		$session->set('valid_admin',$model->username);
        		$this->redirect(Url::to(['index/index']));
        	}
        }
    }

    public function actionLogout()
    {
        $session=Yii::$app->session;
        $session->remove('valid_admin');
        $session->destroy();
        $this->redirect(Url::to(['log/index']));
        
    }
}