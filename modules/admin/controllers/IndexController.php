<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

class IndexController extends Controller
{
	public $layout='admin';
    public function actionIndex()
    {
        return $this->render('index');
    }
}
