<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UserCreateForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->can('backend-user-index')){
			$searchModel = new UserSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(Yii::$app->user->can('backend-user-view')){
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->can('backend-user-create')){
			$model = new UserCreateForm();
			if ($model->load(Yii::$app->request->post())) {
				if($user = $model->signup()){
						return $this->redirect(['view', 'id' => $user->id]);
						}	
			} else {
				return $this->render('create', [
					'model' => $model,
				]);
			}
		}
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->can('backend-user-update')){
			$model = $this->findModel($id);
	
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', [
					'model' => $model,
				]);
			}
		}
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->can('backend-user-delete')){
			$this->findModel($id)->delete();
	
			return $this->redirect(['index']);
		}
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

			if (($model = User::findOne($id)) !== null) {
				return $model;
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
			
    }
}
