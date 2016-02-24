<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\Pagination;

class Msg extends ActiveRecord
{
	public function rules()
	{
		return [
			[['pubtime','ip','author','avater','content'],'safe']
		];
	}
	public function addMsg()
	{
		if(Yii::$app->session->get('valid_user'))
		{
			$this->ip=Yii::$app->request->userIP;
			$old=$this->find()->where(['and',['=','ip',$this->ip],['>','pubtime',time()-300]])->count();
			if($old>2)
			{
				return true;
			}
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
	public function getMsgs()
	{
		$count=$this->find()->count();
		$page=new Pagination(['totalCount'=>$count,'defaultPageSize'=>10]);
		$msgs=$this->find()
			->offset($page->offset)
			->limit($page->limit)
			->all();
		$data['msgs']=$msgs;
		$data['page']=$page;
		return $data;
	}

}