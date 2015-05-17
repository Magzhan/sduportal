<?php

namespace frontend\modules\departmenthead\controllers;

use Yii;
use common\models\UserData;
use frontend\modules\departmenthead\models\StudentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use backend\models\User;
use backend\models\AuthAssignment;

/**
 * StudentsController implements the CRUD actions for UserData model.
 */
class StudentsController extends Controller
{
	
	public $layout = "column2";
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }

    /**
     * Lists all UserData models.
     * @return mixed
     */
    public function actionIndex()
    {		
        
		
        return $this->render('index');
    }

    /**
     * Displays a single UserData model.
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
     * Creates a new UserData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserData::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionDisplaystudents($name = null,$surname = null,$course = null,$faculty = null,$department = null,$group = null,$birthdate = null,$email = null){
		
		$searchSql = '';
		if($name == null && $surname == null && $course == null && $faculty == null && $department == null && $group == null && $birthdate == null && $email == null){
			
		}else{
			$searchSql .= ($name !== "") ? ' AND user_data.name="'.$name.'"':'';
			$searchSql .= ($surname !== "") ? ' AND user_data.surname="'.$surname.'"':'';
			$searchSql .= ($course !== "") ? ' AND user_data.course="'.$course.'"':'';
			$searchSql .= ($faculty !== "") ? ' AND user_data.faculty="'.$faculty.'"':'';
			$searchSql .= ($department !== "") ? ' AND user_data.department="'.$department.'"':'';
			$searchSql .= ($group !== "") ? ' AND user_data.group="'.$group.'"':'';
			$searchSql .= ($birthdate !== "") ? ' AND user_data.birthdate="'.$birthdate.'"':'';
			$searchSql .= ($email !== "") ? ' AND user.email="'.$email.'"':'';
		}
		//echo $searchSql; die();
		$query = new Query;
		$query->select(['user.username AS login','user.email AS email','user_data.name AS name','user_data.surname AS surname','user_data.gender AS gender','user_data.course AS course','faculty.name AS faculty','department.name AS department','group.name AS group','user_data.entry_year AS entry_year','user_data.education_level AS education_level','user_data.payment_type AS payment_type','user_data.birthdate AS birthdate','user_data.mobile1 AS mobile1','user_data.mobile2 AS mobile2','user_data.email2 AS email2','user_data.address AS address','user_data.nationality AS nationality','user_data.document_type AS document_type','user_data.document_number AS document_number','user_data.document_issue_date AS document_issue_data','user_data.document_expire_date AS document_expire_date','user_data.document_issue_organization AS document_issue_organization'])
		->from('user_data')
		->leftJoin('user','user.id = user_data.user_id')
		->leftJoin('faculty','faculty.id = user_data.faculty_id')
		->leftJoin('department','department.id = user_data.department_id')
		->leftJoin('group','group.id = user_data.group_id')
		//->leftJoin('education_history','education_history.user_id = user_data.user_id')
		//->leftJoin('personal_information','personal_information.user_id = user_data.user_id')
		->leftJoin('auth_assignment','auth_assignment.user_id = user_data.user_id')
		->where('auth_assignment.item_name = "student"'.$searchSql)
		->all();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		return $this->renderAjax('_table',[
			'dataProvider' => $dataProvider,
		]);
		//$name = NULL,$surname = NULL,$course = NULL,$faculty = NULL,$department = NULL,$group = NULL,$birthdate = NULL,$email = NULL
	}
	
	public function actionAddstudent(){
			$model = new User;
			$model1 = new AuthAssignment;
			
			if($model->load(Yii::$app->request->post())){
					$model->created_at = date('Y-m-d H:i:s', time());
					$pass = Yii::$app->security->generateRandomString();
					$model->password_hash = Yii::$app->security->generatePasswordHash($pass);
					$model->displayname = $model->username;
					$model->auth_key = Yii::$app->security->generateRandomString();
					$model->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
					$model1->item_name = "student";
					if($model->save()){
						$model1->user_id = $model->id;
						$model1->save();
					}
					\Yii::$app->mailer->compose()
					->setFrom('admin@sduportal.com')
					->setTo($model->email)
					->setSubject('Register')
					->setTextBody('Your login:'.$model->username.' Your password:'.$pass)
					->send();
					$this->redirect(['index']);
				}
			return $this->render('addstudent',[
				'model' => $model,
			]);
	}
	
	public function actionAddstudentgroups(){
			return $this->render('addstudentgroups',[]);
	}
}
