<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\departmenthead\models\StudentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
	.search_table td{
		margin-left:90;
	}
	.search_table tr{
		height:50px;
	}
</style>
<div id="search_panel">
	<table class="search_table">
    	<tr>
        	<td>Name</td><td><input type="text" onChange="searchStudent()" id="student_name"/></td>
			<td>Surname</td><td><input type="text" onChange="searchStudent()" id="student_surname"/></td>
    		<td>Course</td><td><input type="text" onChange="searchStudent()" id="student_course"/></td>
            <td>Faculty</td><td><input type="text" onChange="searchStudent()" id="student_faculty"/></td>
    	</tr>
        <tr>
        	<td>Department</td><td><input type="text" onChange="searchStudent()" id="student_department"/></td>
            <td>Group</td><td><input type="text" onChange="searchStudent()" id="student_group"/></td>
            <td>Birthdate</td><td><input type="text" onChange="searchStudent()" id="student_birthdate"/></td>
            <td>Email</td><td><input type="text" onChange="searchStudent()" id="student_email"/></td>
        </tr>
    </table>
</div>
<div id="table_panel"></div>
<script>
var name = "";
var surname = "";
var course = "";
var faculty = "";
var department = "";
var group = "";
var birthdate = "";
var email = "";

function searchStudent(){
	name = $("#student_name").val();
	surname = $("#student_surname").val();
	course = $("#student_course").val();
	faculty = $("#student_faculty").val();
	department = $("#student_department").val();
	group = $("#student_group").val();
	birthdate = $("#student_birthdate").val();
	email = $("#student_email").val();
	
	$.get("index.php?r=departmenthead/students/displaystudents",function(data){ $("#table_panel").html(data);});
	
	//,{name:name,surname:"s",course:"c",faculty:"f",department:"d",group:"g",birthdate:"b",email:"e"}
}
</script>