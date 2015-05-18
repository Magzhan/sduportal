<?php 
namespace frontend\modules\departmenthead\models;

use yii\base\Model;


class StudentList extends Model{
	
	public $file;
	
	public function rules(){
		return [
			[['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['xlsx','xls'],'checkExtensionByMimeType'=>false],
		];
	}
	
	
}