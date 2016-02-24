<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use yii\data\Pagination;
use Yii;
use yii\db\Query;

class Article extends ActiveRecord{
    public $tag;

    public function rules()
    {
        return [
                [['title','author','abstract','class','address','content','description','pic','id','pubtime','readnum'],'safe'],
                [['title','author','abstract','class'],'required','message' =>'不能为空'],
            ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '标题',
            'author' => '作者',
            'address' => '地址',
            'description' => '简述',
            'abstract' => '摘要',
            'class'=>'分类',
            'pic' =>'图片',
        ];
    }

    public function addArticle()
    {
        if($this->load(Yii::$app->request->post()))
        {
            $this->pic=self::SavePic();
            if($this->pic=='')
            {
                $this->pic='/img/list/'.rand(1,20).'.jpg';
            }
            $this->content=$_POST['content'];
            $this->pubtime=time();
            if ($this->save()) 
            {
               return $this->id;
            }
        }       
    }

    public function updArticle()
    {
        $article=$this->findOne($_POST['article_id']);
        $article->load(Yii::$app->request->post());
        $article->content=$_POST['content'];
        $article->update();
        return true;
    }

    //处理图片的保存
    public function SavePic()
    {
        if(!empty($_FILES['Article']['name']['pic'])&&$_FILES['Article']['error']['pic']==0)
        {
            $ext=substr($_FILES['Article']['name']['pic'],strrpos($_FILES['Article']['name']['pic'],'.')+1);
            if(!is_dir('/img/article/'.$this->class)){
                mkdir('/img/article/'.$this->class);
            }
            $picname=uniqid();
            $fileName='/img/article/'.$this->class.'/'.$picname.'.'.$ext;
            if(move_uploaded_file($_FILES['Article']['tmp_name']['pic'],$fileName)){
                return $fileName;
            }
        }
        return '';
    }

    //获取博客列表
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
            ->orderBy('id DESC')
            ->offset($page->offset)
            ->limit($page->limit)
            ->all();
        $data['articles']=$res;
        $data['page']=$page;
        return $data;
    }

    //获取要修改的信息
    public function getDetail($id)
    {
        $article=$this->findOne($id);
        $tags=(new Query())
        ->select('g.name')
        ->from('article2tag as t')
        ->leftJoin('tag as g','t.tag_id=g.id')
        ->where(['t.article_id'=>$id])
        ->all();
        foreach ($tags as $tag) {
            $article->tag.=','.$tag['name'];
        }
        $article->tag=substr($article->tag,1);
        return $article;
    }
}
