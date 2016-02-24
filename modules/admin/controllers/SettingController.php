<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Setting;

class SettingController extends IndexController
{
	public function actionInfo()
	{
		$setting=new Setting();
		$data['nickName']=$setting->getNickName();
		$data['seteName']=$setting->getSiteName();
		$data['address']=$setting->getAddress();
		$data['desc']=$setting->getDesc();
		$data['model']=$setting;
		return $this->render('info',$data);
	}

	public function actionUpd()
	{
		if(Yii::$app->request->isPost)
		{
			$setting=new Setting;
			if($setting->load(Yii::$app->request->post()))
			{
				if($setting->updSetting())
				{
					$this->redirect(Url::to(['index/index']));
				}
			}
		}
	}
}