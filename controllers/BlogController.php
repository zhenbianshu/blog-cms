<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use \app\models\Test;

class BlogController EXTENDS controller
{
	public function actionIndex()
	{

		return $this->render('index');
	}
}