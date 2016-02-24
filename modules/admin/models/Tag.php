<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use Yii;

class Tag extends ActiveRecord
{

	public function rules()
	{
		return [
			['name','safe'],
			['name','required','message'=>'不能为空'],
		];
	}

	public function attributeLabels()
	{
		return [
			'name'=>'标签',
		];
	}
	public function addTag()
	{
		if($this->load(Yii::$app->request->post()))
		{
			$ids=[];
			$tags=explode(',',$this->name,3);
			$i=0;
			foreach ($tags as $key => $tag) 
			{
				$tag=strtoupper($tag);
				$res=$this->find()->where(['name'=>$tag])->one();
				if($res)
				{
					$ids[]=$res->id;
					continue;
				}else
				{
					$model[$i]=clone $this;
					$model[$i]->name=$tag;
					$model[$i]->save();	
					$ids[]=$model[$i]->id;
					$i++;
				}
				
			}
			return $ids;
		}
		return false;
		
	}
}