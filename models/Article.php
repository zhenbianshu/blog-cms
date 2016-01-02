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
		$where=['and',['class'=>$class],['top'=>'0']];
		$tops=array();
		if(!$class)
		{
			$where=['top'=>'0'];
			$tops=$this->find()->where(['top'=>1])->all();
		}

		//查询并将分页类并入。
		$count=$this->find()
			->where($where)
			->count();
		$page=new Pagination([
	      'totalCount' => $count,
	      'defaultPageSize'   => 10,
	    ]);

		//将分页的数据传入限制
		$res=$this->find()
			->where($where)
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
		$data['tops']=$tops;
		return $data;
	}

	//关联模型，获取文章的分类信息
	public function getMenu()
	{
		return $this->hasOne(Menu::className(),['id'=>'class']);
	}

	public function getByTag()
	{
		$tag=Yii::$app->request->get('id');
		$count=(new Query())
		->from('article2tag')
		->where(['tag_id'=>$tag])
		->count();

		$page=new Pagination([
	      'totalCount' => $count,
	      'defaultPageSize'   => 10,
	    ]);

		$tags=(new query())
			->select('g.name as name,a.id as a_id,g.id as g_id')
            ->from('article AS a')
            ->leftJoin('article2tag AS t','a.id = t.article_id')
            ->rightJoin('tag AS g','g.id = t.tag_id')
            ->where(['t.tag_id'=>$tag])
            ->offset($page->offset)
			->limit($page->limit)
	    	->all();
	    $res=(new query())
	    	->select('a.title,a.pubtime,a.abstract,a.pic,a.description,a.author,a.id,a.readnum,m.name as name')
	    	->from('article as a')
	    	->leftJoin('menu as m','a.class=m.id')
	    	->leftJoin('article2tag as t','t.article_id=a.id')
	    	->where(['t.tag_id'=>$tag])
	    	->offset($page->offset)
			->limit($page->limit)
	    	->all();
	    
	   
	    //返回数据
		$data['page']=$page;
		$data['res']=$res;
		$data['tags']=$tags;
		return $data;
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
		$article=$this->findOne($id);
		$article->readnum++;
		$article->update();
		return $this->find()->where('article.id='.$id,['id'=>'id'])->joinWith('menu')->one();
	}
}