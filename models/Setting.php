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
	public $avater;
	public function rules()
	{
		return [
			[['site_name','address','desc','nick_name','avater'],'safe'],
		];
	}
	public function attributeLabels()
	{
		return [
			'site_name'=>'站点名',
			'address'=>'邮箱地址',
			'desc'=>'个人描述',
			'nick_name'=>'站长昵称',
			'avater'=>'站长头像',
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

}