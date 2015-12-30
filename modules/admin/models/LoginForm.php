<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use Yii;

class LoginForm extends ActiveRecord{
    public $username;
    public $password;
    public $verifyCode;

    public static function tableName()
    {
        return 'zbs_admin';
    }
    public function rules()
    {
        return [
            [['username', 'password','verifyCode'], 'required'],
            ['verifyCode', 'captcha','captchaAction'=>'admin/log/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '管理员',
            'password' => '密码',
            'verifyCode' => '验证码',
        ];
    }

    public function checkUser()
    {
        $user=$this->find()->where(['admin'=>$this->username])->one();
        if($user->passwd==$this->password)
        {
            return true;
        }
    }
}
