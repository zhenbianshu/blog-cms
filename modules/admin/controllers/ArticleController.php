<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Url;
use app\modules\admin\models\Article;
use app\modules\admin\models\Tag;
use app\modules\admin\models\Comment;
use app\modules\admin\models\Article2tag;

class ArticleController extends IndexController
{
//添加博文显示页面和处理信息
    public function actionAdd()
    {
    	$article=new Article();
    	$tag=new Tag();
    	if(Yii::$app->request->isPost)
    	{
    		$at=new Article2tag();
    		$art_id=$article->addArticle();
    		$tag_id=$tag->addTag();
    		if($art_id&&$tag_id)
    		{
    			if($at->addRelation($art_id,$tag_id))
    			{
    				Yii::$app->getSession()->setFlash('success', '添加成功');
    				$this->redirect(Url::to(['article/show']));
    			}
    		}
    	}
		return $this->render('add',['model'=>$article,'tag'=>$tag]);
    }

    //显示全部博文信息
    public function actionShow()
    {
    	$model=new Article();
    	if(Yii::$app->request->isPost)
    	{
    		$class=$_POST['id'];
    		Yii::$app->session->set('class',$class);
    	}
    	$session=Yii::$app->session->get('class');
    	$data=$model->getArticle($session);
    	$data['chosen']=$session;
    	return $this->render('list',$data);
    }

    public function actionDel()
    {
        $article_id=Yii::$app->request->get('id');
        $comment=new Comment();
        $comment->deleteAll(['article_id'=>$article_id]);
        $article=new Article();
        $article2tag=new Article2tag();
        $article2tag->deleteAll(['article_id'=>$article_id]);
        $article->findOne($article_id)->delete();
        $this->redirect(Url::to(['article/show']));
    }

    public function actionUpd()
    {
        $article=new Article();
        if(Yii::$app->request->isPost)
        {
            if($article->updArticle())
            {
                $this->redirect(Url::to(['article/show']));
            }
        }else
        {
            $id=Yii::$app->request->get('id');
            $detail=$article->getDetail($id);
            $tag=new Tag();
            return $this->render('upd',['detail'=>$detail,'model'=>$article,'tag'=>$tag]);
        }
    }

    public function actionTop()
    {
        $id=Yii::$app->request->get('id');
        $model=new Article();
        $article=$model->findOne($id);
        if($article->top==1)
        {
            $article->top=0;
        }else
        {
            $article->top=1;
        }
        $article->update();
        $this->redirect(Url::to(['article/show']));
    }
}