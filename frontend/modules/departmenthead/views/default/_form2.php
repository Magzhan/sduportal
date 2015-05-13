<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Faculty;
use common\models\Department;
use common\models\Group;

/* @var $this yii\web\View */
/* @var $model common\models\UserData */
/* @var $form ActiveForm */
?>
<div class="form2">

    <?php $form = ActiveForm::begin([
		'id' => 'personal_info_form',
		'ajaxDataType' => 'json',
		'ajaxParam' => 'ajax',
	]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'course')->textInput() ?>

    <?= $form->field($model, 'faculty_id')->dropDownList(ArrayHelper::map(Faculty::find()->all(), 'id', 'name'),['onchange' => 'getDepartments($(this).val())','prompt' => '-- Select the Faculty', 'onclick' => 'getDepartments($(this).val())']) ?>
		
    <?= $form->field($model, 'department_id')->dropDownList(ArrayHelper::map(Department::find()->all(),'id', 'name'),['id' => 'dropdown_department','onchange' => 'getGroups($(this).val())', 'prompt' => '', 'onclick' => 'getGroups($(this).val())']) ?>
		
    <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(Group::find()->all(),'id','name'),['id' => 'dropdown_group']) ?>

    <?= $form->field($model, 'entry_year')->textInput() ?>
	
    <?= $form->field($model, 'education_level')->dropDownList([ 'bachelor' => 'Bachelor', 'master' => 'Master', 'ph.d' => 'Ph.D', ], ['prompt' => '']) ?>
	
    <?= $form->field($model, 'payment_type')->dropDownList([ 'self paid' => 'Self paid', 'state grant' => 'State grant', 'scholarship' => 'Scholarship', ], ['prompt' => '']) ?>
	
    <?= $form->field($model, 'birthdate')->textInput() ?>
    
    <?= $form->field($model, 'mobile1')->textInput(['maxlength' => 20]) ?>

  

    <?= $form->field($model, 'mobile2')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'email2')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'document_type')->dropDownList([ 'passport' => 'Passport', 'ID' => 'ID', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'document_number')->textInput() ?>

    <?= $form->field($model, 'document_issue_date')->textInput() ?>

    <?= $form->field($model, 'document_expire_date')->textInput() ?>

    <?= $form->field($model, 'document_issue_organization')->textarea(['rows' => 6]) ?>
	
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form2 -->
<script>
function getDepartments(id){
	$.get("index.php?r=departmenthead/default/getdepartments",{ fid:id}, function(data){ $("#dropdown_department").html(data); });
}

function getGroups(id){
	$.get("index.php?r=departmenthead/default/getgroups",{ did:id}, function(data){ $("#dropdown_group").html(data); });	
}

$("#personal_info_form").submit(function(e) {
    e.preventDefault();
	e.stopImmediatePropagation();
	enterData();
	return false;
});

function enterData(){
	
	var url = "/sduportal/frontend/web/index.php?r=departmenthead/default/update";
	
	var dataObject = $("#personal_info_form").serialize();
	
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		data:dataObject,
		success: function(response){
			//$("#main").html(response);
		},
		error: function(response){},	
	});
}
</script>