<?php

namespace app\controllers;

use Yii;
use app\models\Weeks;

use app\models\WeeksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class WeekController extends Controller
{
	const USER = 1;
	
	 public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
	
	 private function validateAccess($params)
    {
        $cur_user = Yii::$app->user->identity;
        if(Yii::$app->user->isGuest)
            return $this->redirect('../site/login');
        else if(($cur_user->tableName() == 'users' && (($params & self::USER) == 0)))
            return $this->redirect('../site/about');
    }
	
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	 protected function findModel($id)
    {
        if (($model = Weeks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	 public function actionView($id)
    {
        $this->layout = "main";
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionViewWeeks($id)
    {
       // $this->layout='main_layout';
        $this->validateAccess(self::USER);
        $model = Weeks::find()->where(['id' => $id])->one();
        
        if($model == null)
        {
            return $this->render('fail');
        }
        
        else{
            return $this->render('weeks', ['model' => $model]);
        }
    }
	
	public function actionAll()
    {
       // $this->layout='main_layout';
        $this->validateAccess(self::USER);
        $weeks = Weeks::find()->orderBy('week_id');
        if($weeks == null)
        {
            return $this->render('fail');
        }
        else
        {
            return $this->render('all', ['weeks' => $weeks]);
        }
    }

}
