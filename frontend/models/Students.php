<?php 

namespace frontend\models;

use backend\models\User;
use yii\base\Model;
use Yii;

class Students extends Model
{
	public $student_username;
	public $name;
	public $surname;
	public $birthdate;
	public $birthmonth;
	public $birthyear;
	public $year;
	public $department;
	public $faculty;
	public $group;
	
	public function rules(){
		return [
			
		];	
	}
	
	public function findByLogin($login){
		
	}
	
	public function findByName($_name){
		
	}
	
	public function findBySurname($_surname){
		
	}
	
	public function findByBirthDate($_day){
		
	}
	
	public function findByBirthMonth($_month){
		
	}
	
	public function findByBirthYear($_year){
		
	}
	
	public function findByYear($_course){
		
	}
	
	public function findByFaculty($_faculty){
		
	}
	
	public function findByDepartment($_department){
		
	}
	
	public function findByGroup($_group){
		
	}
}