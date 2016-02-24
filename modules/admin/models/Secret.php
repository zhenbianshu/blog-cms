<?php 
namespace app\modules\admin\models;
use yii\db\ActiveRecord;
use Yii;

class Secret extends ActiveRecord{
    public $oldPassword;
    public $password;
    public $conPassword;

    public static function tableName()
    {
        return 'zbs_admin';
    }
    public function rules()
    {
        return [
            [['passwd','admin','id'],'safe','on'=>['upd']],
            [['oldPassword', 'password','conPassword'], 'required','message'=>'不能为空','on'=>['mod']],
            ['conPassword','compare','compareAttribute'=>'password','message'=>'两次密码不一致','on'=>['mod']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldPassword' => '原密码：',
            'password' => '修改密码：',
            'conPassword' => '重复密码：',
        ];
    }
    public function scenarios()
    {
        return [
            'mod'=>['oldPassword','password','conPassword'],
            'upd'=>['passwd','admin','id'],
        ];
    }

    //修改密码
    public function updSecret()
    {
        if($this->load(Yii::$app->request->post()))
        {
            $admin=$this->find()->where(['admin'=>Yii::$app->session->get('valid_admin')])->one();
            if($admin->passwd==md5($this->oldPassword))
            {
                $admin->passwd=md5($this->password);
                $admin->setScenario('upd');
                if($admin->update())
                {
                    return true;
                }
            }
        }
        return false;       
    }

}