<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Menu;
use app\models\Msg;
use app\models\Comment;
use yii\helpers\Url;

class BlogController extends controller
{
	private $class;//当前方法对应的分类ID
	public $layout='list';
	public $defaultAction='list';


	//用构造函数获取分类的ID
	public function beforeAction($action)
	{
		$menu=new Menu();
		$this->class=$menu->getClass();
		return true;
	}

	public function actionList()
	{
		$article=new Article();
		if($this->class!='')
		{
			$className=$this->class->id;
		}
		else{
			$className='';
		}
		$data=$article->getArticle($className);
		if($this->class!='')
		{
			$data['className']=$this->class->name;
		}		
		echo $this->render('list',$data);
	}

	//通过标签查找文章
	public function actionTag()
	{
		$article=new Article();
		$data=$article->getByTag();
		return $this->render('tag',$data);
	}
	public function actionMsg()
	{
		$this->layout='msg';
		$msg=new Msg();
		if(Yii::$app->request->isPost)
		{
			if($msg->addMsg())
			{
				$this->redirect(Url::current());
			}
		}else
		{
			$data=$msg->getMsgs();
			return $this->render('msg',$data);
		}
	}

	public function actionComment()
	{
		if(Yii::$app->request->isPost)
		{
			$comment=new Comment();
			if($comment->addComment())
			{
				$this->redirect(Yii::$app->request->referrer);
			}
		}
	}
}