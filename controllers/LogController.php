<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\Visitor;

class LogController extends Controller
{
	public $layout=false;
    public $enableCsrfValidation = false;

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

    public function actionName()
    {
        $lines=file('./names.txt');
        $line=$lines[rand(0,count($lines)-1)];
        $names=explode(' ',$line);
        echo $names[rand(0,count($names)-1)];
    }

    public function actionLogin()
    {
        if(Yii::$app->request->isPost)
        {
            $visitor=new Visitor();
            $visitor->login();
            $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionLogout()
    {
        $session=Yii::$app->session;
        $session->remove('valid_user');
        $session->remove('user_avater');
        Yii::$app->session->destroy();
        $this->redirect(Yii::$app->request->referrer);
    }
    public function actionQq()
    {
        $session=Yii::$app->session;
        $session->set('history',Yii::$app->request->referrer);
        if(Yii::$app->request->get('id')=='sq')
        {
            $codeUrl='https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101285056&redirect_uri=http%3A%2F%2Fwww.alwayscoding.cn%2Flog%2Fqq.html&state=zbs';
            $this->redirect($codeUrl);
            $this->send();

        }elseif(Yii::$app->request->get('state')=='zbs')
        {
            //通过code产生token
            $code=Yii::$app->request->get('code');
            $tokenUrl='https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101285056&client_secret=a503e1426a9e03ffecf0ba65e098a320&code='.$code.'&redirect_uri=http%3A%2F%2Fwww.alwayscoding.cn%2Flog%2Fqq.html';
            $tokenStr=file_get_contents($tokenUrl);
            $token=substr($tokenStr,13,strpos($tokenStr,'&exp')-13);

            //通过token产生openid
            $openIDInfo=file_get_contents('https://graph.qq.com/oauth2.0/me?access_token='.$token);
            $openID=substr($openIDInfo,strpos($openIDInfo,'openid')+9,32);

            //通过openid获取到信息字符串
            $infoUrl='https://graph.qq.com/user/get_user_info?access_token='.$token.'&oauth_consumer_key=101285056&openid='.$openID;
            $json_info=file_get_contents($infoUrl);

            //解析字符串，将信息存入session
            $info=json_decode($json_info);           
            $session->set('valid_user',$info->nickname);
            $session->set('user_avater',$info->figureurl_qq_2);
        }
        $this->redirect($session->get('history'));
    }
}