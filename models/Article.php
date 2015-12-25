<?php 
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use app\models\Article2Tag;
use app\models\Tag;
use yii\db\Query;

class Article extends ActiveRecord
{
	//通过分类获取到文章列表
	public function getArticle($class='')
	{
		//判断是否需要查询全部
		$where='class='.$class;
		if(!$class)
		{
			$where='1=1';
		}

		//查询并将分页类并入。
		$count=$this->find()
			->where($where,['class'=>$class])
			->count();
		$page=new Pagination([
	      'totalCount' => $count,
	      'defaultPageSize'   => 10,
	    ]);

		//将分页的数据传入限制
		$res=$this->find()
			->where($where,['class'=>$class])
			->joinWith('menu')
			->orderBy('id DESC')
			->offset($page->offset)
			->limit($page->limit)
			->all();
        
        //声明一个空数组存放文章id
        $cond=array();
        foreach ($res as $rec) {
        	$cond[]=$rec->id;
        }

		$tags = (new Query())
            ->select('g.name as name,a.id as a_id,g.id as g_id')
            ->from('article AS a')
            ->leftJoin('article2tag AS t','a.id = t.article_id')
            ->rightJoin('tag AS g','g.id = t.tag_id')
            ->where(array('a.id'=>$cond))
            ->All();

		//返回数据
		$data['page']=$page;
		$data['res']=$res;
		$data['tags']=$tags;
		return $data;
	}

	//关联模型，获取文章的分类信息
	public function getMenu()
	{
		return $this->hasOne(Menu::className(),['id'=>'class']);
	}

	//获取最热文章
	public function getHot()
	{
		$hots = (new Query())
			->from('article')
			->select('title,readnum,id')
			->orderBy('readnum DESC')
			->limit(5)
			->all();
		return $hots;
	}

	//通过文章ID返回文章的详细信息
	public function getDetail($id)
	{
		return $this->find()->where('article.id='.$id,['id'=>'id'])->joinWith('menu')->one();
	}
}