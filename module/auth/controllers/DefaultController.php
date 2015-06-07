<?php

namespace app\module\auth\controllers;

use yii\web\Controller;
use app\module\auth\GooglePlus;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
