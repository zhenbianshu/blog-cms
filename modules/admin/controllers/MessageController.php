<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\Msg;

class MessageController extends IndexController
{
	public function actionMsg()
	{
		$msg=new Msg();
		$data=$msg->getMsgs();
    	return $this->render('msg',$data);
	}
	public function actionDel()
	{
		$class=Yii::$app->request->get('id');
    	$msg=new Msg;
    	$del=$msg->findOne($class);
    	$del->delete();
    	$this->redirect(Url::to(['message/msg']));
	}

}