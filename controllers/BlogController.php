<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Menu;

class BlogController extends controller
{
	private $class;//当前方法对应的分类ID
	public $layout='list';

	//用构造函数获取分类的ID
	public function beforeAction($action)
	{
		$menu=new Menu();
		$this->class=$menu->getClass();
		return true;
	}

	public function actionIndex()
	{
		$article=new Article($this->class);
		$data=$article->getArticle();
		echo $this->render('list',$data);
	}

	//通过标签查找文章
	public function actionTag()
	{

	}
}