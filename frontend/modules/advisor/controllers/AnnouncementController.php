<?php

namespace frontend\modules\advisor\controllers;

use Yii;
use common\models\Announcement;
use common\models\AnnouncementState;
use frontend\models\AnnouncementForm;
use common\models\AnnouncementVisibility;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * AnnouncementController implements the CRUD actions for Announcement model.
 */
class AnnouncementController extends Controller
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
     * Lists all Announcement models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->can('frontend-advisor-announcement')){
			$query = new Query;
			$query->select(['announcement.id AS id','announcement.subject AS subject','announcement.content AS content','announcement.DateCreated AS date','announcement.LastUpdate AS changed','announcement_condition.name AS status','announcement_publicity.name AS publicity'])
			->from('announcement')
			->leftJoin('announcement_state','announcement_state.announcement_id = announcement.id')
			->leftJoin('announcement_condition','announcement_condition.id = announcement_state.announcement_condition_id')
			->leftJoin('announcement_publicity','announcement_publicity.id = announcement_state.announcement_publicity_id')
			->orderBy([
				'announcement.DateCreated' => SORT_DESC,
			])
			->where('announcement.user_id = :me',[':me' => Yii::$app->user->identity->id])
			->all();
			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);
	
			return $this->render('index', [
				'dataProvider' => $dataProvider,
			]);
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
}
