<?php
namespace frontend\models;

use common\models\Announcement;
use common\models\AnnouncementCondition;
use common\models\AnnouncementPublicity;
use common\models\AnnouncementState;
use common\models\AnnouncementVisibility;
use common\models\Group;
use common\models\Department;
use common\models\Faculty;
use yii\base\Model;
use Yii;

class AnnouncementForm extends Model
{
	public $subject;
	public $content;
	public $publicity;
	public $visibility;
	public $id;
	
	public function rules(){
			return [
				[['subject', 'content', 'publicity'], 'required'],
				[['content'], 'string'],
				[['subject'], 'string', 'max' => 255]
			];
		}
		
	public function create(){
		date_default_timezone_set('Asia/Almaty');
		if($this->validate()){
		$announcement = new Announcement;
		$announcement_state = new AnnouncementState;
		
		$announcement->subject = $this->subject;
		$announcement->content = $this->content;
		$announcement->DateCreated = date('Y-m-d H:i:s', time());
		$announcement->user_id = Yii::$app->user->identity->id;	
		
		
		if($announcement->save()){
				$announcement_state->DateCreated = $announcement->DateCreated;
				$announcement_state->announcement_id = $announcement->id;
				$announcement_state->announcement_publicity_id = $this->publicity;
				$announcement_state->user_id = $announcement->user_id;
				if(Yii::$app->user->can('administrator')){
					$announcement_state->announcement_condition_id = 1;
				}else if(Yii::$app->user->can('departmenthead')){
					$announcement_state->announcement_condition_id = 1;
				}else if(Yii::$app->user->can('advisor')){
					$announcement_state->announcement_condition_id = 1;
				}else if(Yii::$app->user->can('teacher')){
					$announcement_state->announcement_condition_id = 1;
				}else if(Yii::$app->user->can('methodologist')){
					$announcement_state->announcement_condition_id = 1;
				}else if(Yii::$app->user->can('student')){
					if($this->publicity == 3){
							$announcement_state->announcement_condition_id = 1;
					}else if($this->publicity == 1 || $this->publicity == 2){
							$announcement_state->announcement_condition_id = 3;
					}
				}
				if($this->publicity == 2){
					$vis = $_POST['AnnouncementForm']['visibility'];
					foreach($vis as $v){
						$announcement_visibility = new AnnouncementVisibility;
						$announcement_visibility->announcement_id = $announcement->id;
						$announcement_visibility->group_id = $v;
						$announcement_visibility->save();
					}
					}
				$announcement_state->save();
				return $announcement;
			}
		}
			return null;
	}
	
	public function update($id){
		date_default_timezone_set('Asia/Almaty');
		if($this->validate()){
			$announcement = Announcement::findOne($id);
			$announcement->subject = $this->subject;
			$announcement->content = $this->content;
			$announcement_state = AnnouncementState::find()->where(['announcement_id'=>$id])->one();
			$announcement_state->announcement_publicity_id = $this->publicity;
			$announcement_visibility = null;
			if(Yii::$app->user->can('student')){
				if($this->publicity == 3){
							$announcement_state->announcement_condition_id = 1;
				}else if($this->publicity == 1 || $this->publicity == 2){
							$announcement_state->announcement_condition_id = 3;
				}
			}
			AnnouncementVisibility::deleteAll('announcement_id = :_id',[':_id' => $id]);
			if($announcement_state->announcement_publicity_id == 2){
				$vis = $_POST['AnnouncementForm']['visibility'];
				foreach($vis as $v){
					$announcement_visibility = new AnnouncementVisibility;
					$announcement_visibility->announcement_id = $id;
					$announcement_visibility->group_id = $v;
					$announcement_visibility->save();
					}
			}
			if($announcement_state->announcement_condition_id == 2){
				$announcement_state->announcement_condition_id = 3;
			}
			$announcement->save();
			$announcement_state->save();
			return $announcement;
		}
		return null;
	}
}