<?php

namespace app\controllers;

use Yii;
use app\models\Notes;
use app\models\User;
use app\models\NotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class NoteController extends Controller
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
        if (($model = Notes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionCreate()
    {
      //  $this->layout = "main_layout";
		$this->validateAccess(self::USER);
        $user = Yii::$app->user->identity;
        $model = new Notes();
        $model->user_id =  $user->id;

        if (isset($_FILES['Note']) && $_FILES['Note']['note_text']['foto']!="") {
            if (!in_array($_FILES['Note']['type']['foto'],$this->image_array))
                $model->addError('foto','Доступные расширения для файла: jpg, gif, png.');
            else
            {
                $rnd = rand(0,9999);
                $uploadedFile = UploadedFile::getInstance($model,'foto');
                $fileName = 'files/'.$rnd.'_'.$uploadedFile->name;
                $model->foto = $fileName;
                $uploadedFile->saveAs($fileName);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['user/notes']);
        } else {
            return $this->render('create', [
                'crModel' => $model,
                'lcModel' => Yii::$app->user->identity,
                'is_user' => true,
            ]);
        }
    }
	
	public function actionViewNotes($id)
    {
       // $this->layout='main_layout';
        $this->validateAccess(self::USER);
        $model = Notes::find()->where(['id' => $id])->one();
        
        if($model == null)
        {
            return $this->render('fail');
        }
        
        else{
            return $this->render('notes', ['model' => $model]);
        }
    }
	
	public function actionAll()
    {
       // $this->layout='main_layout';
        $this->validateAccess(self::USER);
        $notes = Notes::find()->orderBy('note_id');
        if($notes == null)
        {
            return $this->render('fail');
        }
        else
        {
            return $this->render('all', ['notes' => $notes]);
        }
    }

}
