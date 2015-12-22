<?php
namespace app\models;

use Yii;
use yii\base\Model;
class Test extends Model
{
	public function __construct()
	{
		$_POST=['name'=>'lili','age'=>20,'address'=>'桃花岛','password'=>123456];
		$this->scenario='register';
	}
	public function secarios()
	{
		return [
			'login'=>['name','password'],
			'register'=>['name','password','age','address'],
		];
	}
	public function rules()
	{
		return [
			[['name','age','password','address'],'required'],
		];
	}
	public function getKey()
	{
	}
	
}