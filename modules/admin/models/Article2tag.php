<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use Yii;

class Article2tag extends ActiveRecord
{

	public function rules()
	{
		return [
			[['article_id','tag_id'],'safe'],
		];
	}
	public function addRelation($article,$tags)
	{
		$this->article_id=$article;
		$i=0;
		foreach ($tags as  $tag) 
		{
			$model[$i]=clone $this;
			$model[$i]->tag_id=$tag;
			$model[$i]->save();
		}

		return true;
	}

}