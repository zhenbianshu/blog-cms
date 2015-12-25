<?php 
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Setting extends ActiveRecord
{
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