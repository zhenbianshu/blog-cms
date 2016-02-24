<?php 
namespace app\modules\admin\models;

use app\modules\admin\models\Article;
use yii\db\ActiveRecord;
use yii\data\Pagination;
use Yii;

class Msg extends ActiveRecord
{
	public function getMsgs()
	{
		$count=$this->find()->count();
		$page=new Pagination([
          'totalCount' => $count,
          'defaultPageSize'   => 10,
        ]);
        $res=$this->find()
            ->orderBy('id DESC')
            ->offset($page->offset)
            ->limit($page->limit)
            ->all();
        $data['msgs']=$res;
        $data['page']=$page;
        return $data;
	}
}