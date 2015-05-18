<?php

namespace frontend\modules\departmenthead\controllers;

use Yii;
use common\models\AnnouncementState;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * AnnouncementStateController implements the CRUD actions for AnnouncementState model.
 */
class AnnouncementstateController extends Controller
{
	
	public $layout = 'column2';
	
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
     * Lists all AnnouncementState models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->can('frontend-departmenthead-announcement')){
			$query = new Query;
			$query->select(['announcement.subject AS subject','user_data.name AS name','user_data.surname AS surname', 'announcement_condition.name AS condition','announcement.id AS id','announcement.DateCreated AS date','announcement.content AS content','announcement.user_id AS user_id'])
			->from('announcement_state')
			->leftJoin('announcement', 'announcement.id = announcement_state.announcement_id')
			->leftJoin('user_data', 'user_data.user_id = announcement.user_id')
			->leftJoin('announcement_condition', 'announcement_condition.id = announcement_state.announcement_condition_id')
			->orderBy([
				'announcement.DateCreated' => SORT_DESC,
			])
			->all();
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);
	
			return $this->render('index', [
				'dataProvider' => $dataProvider,
			]);
		}
    }


	public function actionAccept($id){
		if(Yii::$app->user->can('frontend-departmenthead-announcement')){
				$model = $this->findModel($id);
				$model->announcement_condition_id = 1;
				$model->save();
		}
	}
	
	public function actionDecline($id){
		if(Yii::$app->user->can('frontend-departmenthead-announcement')){
				$model = $this->findModel($id);
				$model->announcement_condition_id = 2;
				$model->save();
		}
	}
   
    

    /**
     * Finds the AnnouncementState model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnnouncementState the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnnouncementState::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
