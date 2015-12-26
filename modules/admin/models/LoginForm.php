<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
class LoginForm extends ActiveRecord{
    public $username;
    public $password;
    public $veryKey;
    public static function tableName()
    {
        return 'zbs_admin';
    }
    
    public function rules()
    {
        return [
            [['username', 'password','veryKey'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '管理员',
            'password' => '密码',
            'veryKey' => '验证码',
        ];
    }
}
