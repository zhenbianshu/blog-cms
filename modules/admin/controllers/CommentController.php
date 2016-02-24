<?php
namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\Comment;

class CommentController extends IndexController
{
	//显示全部评论信息
    public function actionList()
    {
    	$comment=new Comment();
    	$data=$comment->getComments();
    	return $this->render('list',$data);
    }

    public function actionDel()
    {
    	$class=Yii::$app->request->get('id');
    	$comment=new Comment;
    	$del=$comment->findOne($class);
    	$del->delete();
    	$this->redirect(Url::to(['comment/list']));
    }

}