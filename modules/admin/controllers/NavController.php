<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\models\Menu;
use app\modules\admin\models\Article;

class NavController extends IndexController
{
	public function actionMenu()
	{
		$menu=new Menu();
		$data=$menu->getMenuInfo();
		$data['model']=$menu;
		return $this->render('menu',$data);
	}
	public function actionAdd()
	{
		$menu=new Menu();
		if(Yii::$app->request->isPost)
		{
			if($menu->addMenu())
			{
				$this->redirect(Url::to(['nav/menu']));
			}
		}
	}

	public function actionDel()
	{
		$article=new Article();
		$class=Yii::$app->request->get('id');
		$article->deleteAll(['class'=>$class]);
		$menu=new Menu();
		$nav=$menu->findOne($class);
		$nav->delete();
		$this->redirect(Url::to(['nav/menu']));
	}
}