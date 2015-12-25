<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

class Comment extends ActiveRecord
{
	public function getComments($id)
	{
		$comments=(new query())
			->from('comment')
			->select('content,author,pubtime,avater')
			->where('article='.$id,['article'=>'article'])
			->orderBy('pubtime ASC')
			->all();
		return $comments;
	}
}