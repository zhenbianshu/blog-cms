<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Visitor extends Model
{
	public $name;
	public $verify;

	public function rules()
    {
        return [
            [['name', 'verify'], 'required','message'=>'不能为空'],
            ['verify', 'captcha','captchaAction'=>'log/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '登陆用名',
            'verify' => '验证码',
        ];
    }

    public function login()
    {
       if($this->load(Yii::$app->request->post())&&$this->validate())
        {
            if(($this->name=='枕边书')&&(Yii::$app->request->userIP!='118.74.250.156'))
            {
                return false;
            }
            $session=Yii::$app->session;
            $session->set('valid_user',$this->name);
            $session->set('user_avater','/img/avater/'.rand(1,50).'.jpg');
            return true;
        }
    }
}