<?php 
namespace app\modules\admin\models;

use app\modules\admin\models\Article;
use yii\db\ActiveRecord;
use yii\data\Pagination;
use Yii;

class Comment extends ActiveRecord
{
	public function getComments()
	{
		$count=$this->find()->count();
		$page=new Pagination([
          'totalCount' => $count,
          'defaultPageSize'   => 10,
        ]);
        $res=$this->find()
            ->orderBy('id DESC')
            ->joinWith('article')
            ->offset($page->offset)
            ->limit($page->limit)
            ->all();
        $data['comments']=$res;
        $data['page']=$page;
        return $data;
	}
	public function getArticle()
	{
		return $this->hasOne(Article::className(),['id'=>'article_id']);
	}
}