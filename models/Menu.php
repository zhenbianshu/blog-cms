<?php
namespace app\models;

use yii\db\ActiveRecord;
class Menu extends ActiveRecord
{
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
				$list[$i]['url']=array("/index/".$top->attributes['route']);
			}
		$i++;
		}
		//exit;
		return $list;
	}
	public function getNext($secondMenu,$pmenu)
	{
		$child=array();
		$i=0;
		foreach ($secondMenu as $menu)
		{
			if($menu->attributes['pmenu']==$pmenu)
			{
				$child[$i]['label']=$menu->attributes['name'];
				$child[$i]['url']=array("/index/".$menu->attributes['route']);
				$i++;
			}
		}
		return $child;
	}
}