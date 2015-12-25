<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
class Menu extends ActiveRecord
{

	//分别获取一二级的菜单，进行拼合
	public function getMenuList()
	{
		$topMenu=$this->find()->where('level=1',['level'=>'level'])->all();
		$secondMenu=$this->find()->where('level=2',['level'=>'level'])->all();
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
				$list[$i]['url']=array("/blog/index/?class".$top->attributes['route']);
			}
		$i++;
		}
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
				$child[$i]['url']=array("/blog/index&class=".$menu->route);
				$i++;
			}
		}
		return $child;
	}

	public function getClass()
	{
		$action=Yii::$app->controller->action->id;
		$class=$this->find()->where('route=:action',['action' => $action])->one();
		if(!$class)
		{
			return false;
		}
		return $class->attributes['id'];
	}
}