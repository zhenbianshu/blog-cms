<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Menu extends ActiveRecord
{
	public function rules()
	{
		return [
			[['name','route','pmenu','level'],'safe'],
			[['name','route'],'required','message'=>'不能为空'],
		];
	}
	public function attributeLabels()
	{
		return [
		'name'=>'菜单名',
		'route'=>'路由名',
		'pmenu'=>'父菜单',
		];
	}
	//获取一级菜单
	public function getFirst()
	{
		return $this->find()->where('level=1',['level'=>'level'])->all();
	}

	//获取二级菜单
	public function getSecond()
	{
		return $this->find()->where('level=2',['level'=>'level'])->all();
	}

	//分别获取一二级的菜单，进行拼合
	public function getMenuList()
	{
		$topMenu=$this->getFirst();
		$secondMenu=$this->getSecond();
		$list=array();
		$i=0;
		foreach ($topMenu as $top)
		{
			if($child=self::getNext($secondMenu,$top->attributes['id']))
			{
				$list[$i]['label']=$top->attributes['name'];
				$list[$i]['items']=$child;
			}else
			{
				$list[$i]['label']=$top->attributes['name'];
				$list[$i]['url']=array("/blog/index/?id".$top->attributes['route']);
			}
		$i++;
		}
		$list[$i]['label']='留言板';
		$list[$i]['url']=['blog/msg'];
		return $list;
	}

	//通过父ID找到下面的子菜单，并拼接入child、
	public function getNext($secondMenu,$pmenu)
	{
		$child=array();
		$i=0;
		foreach ($secondMenu as $menu)
		{
			if($menu->attributes['pmenu']==$pmenu)
			{
				$child[$i]['label']=$menu->attributes['name'];
				$child[$i]['url']=array("/blog/index&id=".$menu->route);
				$i++;
			}
		}
		return $child;
	}

	//通过菜单名找到菜单ID返回。
	public function getClass()
	{
		$action=Yii::$app->request->get('id');
		$class=$this->find()->where(['route' => $action])->one();
		if(!$class)
		{
			return false;
		}
		return $class->attributes['id'];
	}

	//获取全部二级菜单
	public function getMenuOption()
	{
		$data=array();
		$secondMenu=$this->getSecond();
		foreach ($secondMenu as $menu) {
			$data[$menu->id]=$menu->name;
		}
		return $data;
	}

	//获取全部菜单
	public function getMenuInfo()
	{
		$data['firsts']=$this->getFirst();
		$data['seconds']=$this->getSecond();
		return $data;
	}

	//添加一个菜单
	public function addMenu()
	{
		if($this->load(Yii::$app->request->post()))
		{
			if($this->pmenu=='')
			{
				$this->level=1;
			}else
			{
				$this->level=2;
			}
			if($this->save())
			{
				return true;
			}
		}
	}
}