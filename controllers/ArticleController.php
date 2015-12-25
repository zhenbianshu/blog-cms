<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Comment;

class ArticleController extends controller
{
	public $layout='article';

	public function actionDetail()
	{
		$id = Yii::$app->request->get('id');

		$article = new Article();
		$detail = $article->getDetail($id);

		$comment = new Comment();
		$comments = $comment->getComments($id);

		echo $this->render('detail',['detail'=>$detail,'comments'=>$comments]);
	}
}