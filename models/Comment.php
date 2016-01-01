<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\ZbsFunction;

class Comment extends ActiveRecord
{
	public function getComments($id)
	{
		$comments=(new query())
			->from('comment')
			->select('content,author,pubtime,avater')
			->where(['article_id'=>$id])
			->orderBy('pubtime ASC')
			->all();
		return $comments;
	}

	public function addComment()
	{
		if(Yii::$app->session->get('valid_user'))
		{
			$this->ip=Yii::$app->request->userIP;
			$old=$this->find()->where(['and',['=','ip',$this->ip],['>','pubtime',time()-300]])->count();
			if($old>2)
			{
				return true;
			}
			$this->article_id=ZBSFunction::getParam(Yii::$app->request->referrer,'id');
			$this->content=htmlspecialchars($_POST['content']);
			$this->author=Yii::$app->session->get('valid_user');
			$this->avater=Yii::$app->session->get('user_avater');
			$this->pubtime=time();
			
			if($this->save())
			{
				return true;
			}
		}

	}
}