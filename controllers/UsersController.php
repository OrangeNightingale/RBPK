<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * LecturerController implements the CRUD actions for Lecturer model.
 */
class UsersController extends Controller
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
        else if(($cur_user->tableName() == 'lecturer' && (($params & self::USER) == 0)))
            return $this->redirect('../site/about');
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->user->returnUrl);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Yii::$app->user->returnUrl);
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lecturer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionProfile()
    {
        //$this->layout = "main_layout";
		//$this->layout='main_page';
        $model = Yii::$app->user->getIdentity();

        return $this->render('weeks', [
                'model' => $model
        ]);
    }
   
    public function actionProfileUpdate()
    {
        $this->validateAccess(self::USER);
        $this->layout = "main_layout";
        $model = Yii::$app->user->getIdentity();

        if ($model->load(Yii::$app->request->post())) {
            $info = $_POST['User'];

            if(isset($info['password'])&&isset($info['confirmation']))
            {
                $model->password = $info['password'];
                $model->confirmation = $info['confirmation'];
            }
            if($model->updateLc())
            {
                return $this->redirect(Yii::$app->user->returnUrl);
            } else{

            }
        }
        else
        {
             return $this->render('profile_update', [
                'model' => $model
        ]);
        }
    }

   
    

    public function sendMail($emailTo, $emailFrom, $subject, $body){
        $this->validateAccess(self::USER);
        Yii::$app->mailer->compose()
                ->setFrom($emailFrom)
                ->setTo($emailTo)
                ->setSubject($subject)
                ->setTextBody($body)
                ->send();
    }
}
