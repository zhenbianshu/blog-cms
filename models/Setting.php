<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Setting extends ActiveRecord
{
	public $site_name;
	public $nick_name;
	public $desc;
	public $address;
	public function rules()
	{
		return [
			[['site_name','address','desc','nick_name'],'safe'],
		];
	}
	public function attributeLabels()
	{
		return [
			'site_name'=>'站点名',
			'address'=>'邮箱地址',
			'desc'=>'个人描述',
			'nick_name'=>'站长昵称',
		];
	}
	public function getSiteName()
	{
		return $this->find()->where(['opt'=>'site_name'])->one();
	}
	public function getDesc()
	{
		return $this->find()->where(['opt'=>'desc'])->one();
	}
	public function getNickName()
	{
		return $this->find()->where(['opt'=>'nick_name'])->one();
	}
	public function getAddress()
	{
		return $this->find()->where(['opt'=>'address'])->one();
	}
	public function updSetting()
	{
		if(!empty($this->nick_name))
		{
			$setting=$this->findOne(2);
			$setting->value=$this->nick_name;
			$setting->update();
		}
		if(!empty($this->site_name))
		{
			$setting=$this->findOne(1);
			$setting->value=$this->site_name;
			$setting->update();
		}
		if(!empty($this->desc))
		{
			$setting=$this->findOne(3);
			$setting->value=$this->desc;
			$setting->update();
		}
		if(!empty($this->address))
		{
			$setting=$this->findOne(4);
			$setting->value=$this->address;
			$setting->update();
		}
		
		if($_FILES['avater']['error']==0)
		{
			$this->saveAvater();
		}
		return true;
	}
	public function saveAvater()
	{
		if(file_exists('./img/avater.jpg'))
		{
			unlink('./img/avater.jpg');
		}
		move_uploaded_file($_FILES['avater']['tmp_name'],'./img/avater.jpg');
	}

}