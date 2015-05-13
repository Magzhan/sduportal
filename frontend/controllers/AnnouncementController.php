<?php

namespace frontend\controllers;

use Yii;
use common\models\Announcement;
use common\models\AnnouncementSearch;
use common\models\AnnouncementState;
use common\models\AnnouncementVisibility;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\AnnouncementForm;
use common\models\Group;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\models\UserData;

/**
 * AnnouncementController implements the CRUD actions for Announcement model.
 */
class AnnouncementController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Announcement models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->can('frontend-announcement-index')){
		$groupID = (UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one() == null) ? 0:UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one()->group_id;
		$query = new Query;
		$query ->select(['announcement.id AS id', 'announcement.subject AS subject', 'announcement.content AS content', 'announcement.DateCreated AS created_at', 'announcement.LastUpdate AS last_edited', 'announcement_publicity.id AS publicity', 'announcement_condition.id AS status', 'user_data.name AS name', 'user_data.surname AS surname', 'user_data.group_id AS group_id', 'announcement_visibility.group_id AS visibility'])
		->from('announcement')
		->leftJoin('announcement_state', 'announcement_state.announcement_id = announcement.id')
		->leftJoin('announcement_publicity', 'announcement_publicity.id = announcement_state.announcement_publicity_id')
		->leftJoin('announcement_condition', 'announcement_condition.id = announcement_state.announcement_condition_id')
		->leftJoin('user_data', 'user_data.user_id = announcement.user_id')
		->leftJoin('announcement_visibility', 'announcement_visibility.announcement_id = announcement.id')
		->where('announcement_state.announcement_publicity_id = 1 and announcement_state.announcement_condition_id = 1')
		->orWhere('announcement_state.announcement_publicity_id = 2 and announcement_visibility.group_id IS NOT NULL and announcement_visibility.group_id = :same_group and announcement_state.announcement_condition_id = 1',[':same_group' => $groupID])
		->orWhere('announcement_state.announcement_publicity_id = 3 and user_data.group_id = :onegroup', [':onegroup' => $groupID])
		->orderBy([
			'announcement.DateCreated' => SORT_DESC,
		])
		->all();
		//$command = $query->createCommand();
		//$data = $command->queryAll();
		
        $searchModel = new AnnouncementSearch();
        $dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
					'pageSize' => 20,
				],
			]);
		$this->autoDelete();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		}else{
			//return $this->redirect('');
			}
    }

    /**
     * Displays a single Announcement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(Yii::$app->user->can('frontend-announcement-view')){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
		}
    }

    /**
     * Creates a new Announcement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->can('frontend-announcement-create')){
        $model = new AnnouncementForm();

        if ($model->load(Yii::$app->request->post())) {
			if($announcement = $model->create()){
            	return false;//$this->redirect(['view', 'id' => $announcement->id]);
			}
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
		}
    }

    /**
     * Updates an existing Announcement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		if(Yii::$app->user->can('frontend-announcement-update') && Yii::$app->user->identity->id === Announcement::findOne($id)->user_id){
        $model = $this->findModel($id);
		$model3 = AnnouncementState::find()->where(['announcement_id'=>$id])->one();
		$model2 = new AnnouncementForm;
		$model2->subject = $model->subject;
		$model2->content = $model->content;
		$model2->publicity = $model3->announcement_publicity_id;
		$model2->id = $id;
		if($model2->publicity == 2){
			$model2->visibility = AnnouncementVisibility::find()->where(['announcement_id'=>$id])->all();
			}
        if ($model2->load(Yii::$app->request->post())) {
			if($announcement = $model2->update($id)){
            	//return $this->redirect(['view', 'id' => $announcement->id]);
			}
        } else {
            return $this->renderAjax('update', [
                'model' => $model2,
            ]);
        }
		}
    }

    /**
     * Deletes an existing Announcement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->can('frontend-announcement-delete') && Yii::$app->user->identity->id === Announcement::findOne($id)->user_id){
		$publicity = AnnouncementState::find()->where(['announcement_id' => $id])->one()->announcement_publicity_id;
		if($publicity == 2)
			AnnouncementVisibility::deleteAll('announcement_id = :announce_id', [':announce_id' => $id]);
		AnnouncementState::deleteAll('announcement_id = :id', [':id' => $id]);
        $this->findModel($id)->delete();

        //return $this->redirect(['index']);
		}
    }

    /**
     * Finds the Announcement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Announcement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Announcement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionList(){
		if(Yii::$app->user->can('frontend-announcement-list')){
			$groups = Group::find()->all();
			//$n = Group::find()->all()->count();
			
			foreach($groups as $group){
				echo '<label><input type="checkbox" name="AnnouncementForm[visibility][]" value="'.$group->id.'">'.$group->name.'</label>';
				}
		}
	}
	
	public function actionListannouncements($id){
		if(Yii::$app->user->can('frontend-announcement-list')){
			$groups = Group::find()->asArray()->all();
			$announcement_groups = AnnouncementVisibility::find()->where(['announcement_id'=>$id])->all();
			//$n = Group::find()->all()->count();
			$query = new Query;
			$query->select(['group.id AS id','group.name AS group_name','group.department_id AS department_id','department.name AS department','faculty.id AS faculty_id','faculty.name AS faculty'])
			->from('announcement_visibility')
			->leftJoin('group','group.id = announcement_visibility.group_id')
			->leftJoin('department','department.id = group.department_id')
			->leftJoin('faculty','faculty.id = department.faculty_id')
			->where('announcement_visibility.announcement_id = :aid',[':aid' => $id])
			->all();
			$command = $query->createCommand();
			$data = $command->queryAll();
			
			
			foreach($data as $group){
				echo '<label><input type="checkbox" checked name="AnnouncementForm[visibility][]" value="'.$group['id'].'">'.$group['group_name'].'</label>';
			}
			//print_r($groups); die();
			
			foreach($groups as $group){
				foreach($data as $dat){
					if($group['id'] !== $dat['id']){
						echo '<label><input type="checkbox" name="AnnouncementForm[visibility][]" value="'.$group['id'].'">'.$group['name'].'</label>';
					}
				}
			}
		}
	}
	
	protected function autoDelete(){
		
		date_default_timezone_set('Asia/Almaty');
		$date = new \DateTime();
		$date->sub(new \DateInterval('P0Y0M1DT0H0M0S'));
		$date = $date->format('Y-m-d H:i:s');
		
		//AnnouncementState::deleteAll('announcement_condition_id = 2 AND LastUpdate < :date',[':date' => $date]);
		
		//Announcement::deleteAll('announcement_state.announcement_id IS NULL');
	}	
}
