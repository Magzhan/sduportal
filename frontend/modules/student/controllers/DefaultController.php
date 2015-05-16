<?php

namespace frontend\modules\student\controllers;

use Yii;
use yii\web\Controller;
use common\models\UserData;
use common\models\User;
use common\models\Faculty;
use common\models\Department;
use common\models\Group;
use common\models\PersonalInformation;
use common\models\EducationHistory;

class DefaultController extends Controller
{
	
	public $layout = "column2";
	
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionProfile(){
		$model = UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
		$model = ($model == null) ? false:$model;
		
		$model1 = User::findOne(Yii::$app->user->identity->id);
		
		$model2 = PersonalInformation::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
		$model2 = ($model2 == null) ? false:$model2;
		
		$model3 = EducationHistory::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
		$model3 = ($model3 == null) ? false:$model3;
		
		return $this->render('profile', [
			'model' => $model,
			'model1' => $model1,
			'model2' => $model2,
			'model3' => $model3,
		]);
	}
	
	public function actionGetdepartments($fid){
		$departments = Department::find()->where(['faculty_id' => $fid])->all();
		foreach($departments as $department){
			echo '<option value="'.$department->id.'">'.$department->name.'</option>';	
		}
	}
	
	public function actionGetgroups($did){
		$groups = Group::find()->where(['department_id' => $did])->all();
		foreach($groups as $group){
			echo '<option value="'.$group->id.'">'.$group->name.'</option>';
		}
	}
	
	public function actionUpdate(){
		$model = UserData::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
		$model = ($model == null) ? false:$model;
		if($model->load(Yii::$app->request->post())){
			$model->save();
		}
		return $this->renderAjax('_form2', [
			'model' => $model,
		]);
	}
	
	public function actionCreateuserdata(){
		$model = new UserData;
		
		if($model->load(Yii::$app->request->post())){
			$model->user_id = Yii::$app->user->identity->id;
			$model->save();
		}
		
		return $this->renderAjax('_form',[
			'model' => $model,
		]);
	}
	
	public function actionPrimaryinfo(){
		$model = \backend\models\User::findOne(Yii::$app->user->identity->id);
				
		if($model->load(Yii::$app->request->post())){
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			$model->save();
		}
		
		$model->password_hash = "";
		return $this->renderAjax('_form3', [
			'model' => $model,
		]);
	}
	
	public function actionEducation(){
		$model = EducationHistory::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
		$model = ($model !== null) ? model: new EducationHistory;
		$model->user_id = Yii::$app->user->identity->id;
		if($model->load(Yii::$app->request->post())){
			$model->save();
		}
		
		return $this->renderAjax('_form4',[
			'model' => $model,
		]);
	}
	
	public function actionRelatives(){
		$model = PersonalInformation::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
		$model = ($model !== null) ? model:new PersonalInformation;
		$model->user_id = Yii::$app->user->identity->id;
		if($model->load(Yii::$app->request->post())){
			$model->save();
		}
		
		return $this->renderAjax('_form5',[
			'model' => $model,
		]);	
	}
}
