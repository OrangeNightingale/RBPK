<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegistrationForm;



class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actionMain()
	{
        if(Yii::$app->user->identity != null)
        {
          
            if(Yii::$app->user->identity->tableName() == 'users')
                return $this->redirect('user/profile');
        }
        $this->layout='main_page';
		return $this->render('main');
	}

    public function actionLogin()
    {
       // $this->layout='main_layout';
	  $this->layout='main_page';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            if(Yii::$app->user->identity->tableName() == 'users')
                return $this->redirect('../user/profile');
            else return $this->redirect('../site/about');
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistration()
    {
        //$this->layout = "main_layout";
		$this->layout='main_page';

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();

        if(array_key_exists('RegistrationForm', $_POST))
        {
            $info = $_POST['RegistrationForm'];

        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->layout = "main_alternative";
            if($model->register())
                return $this->render('success_registration');
            else
            {
                return $this->render('fail_registration');
            }
        } else {
            return $this->render('registration', ['model'=>$model,]);
        }
    }

    public function actionContact()
    {
        $model = new ContactForm();

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
             return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionFailRecovery()
    {
        $this->layout='main_alternative';
        return $this->render('fail_recovery');
    }

    public function actionSuccessRecovery()
    {
        $this->layout='main_alternative';
        return $this->render('success_recovery');
    }

    public function actionRecovery()
    {
       // $this->layout='main_layout';
        $model = new LoginForm();
        $email = $_POST['email'];

        if($model->recovery($email)){
            return $this->redirect('success-recovery');
        }
        else{
            return $this->redirect('fail-recovery');
        }
    }
	public function actionGooglePlus()
    {
        //return $this->render('googleplus');
    }
}
