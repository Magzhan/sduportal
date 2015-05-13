<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EducationHistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="education-history-form">

    <?php $form = ActiveForm::begin([
		'id' => 'educationHistoryForm',
	]); ?>
		<input type="hidden" value="<?php echo $model->isNewRecord; ?>" id="isUpdateOrSave"/>
        <input type="hidden" value="<?php echo $model->id; ?>" id="modelID"/>
    <?= $form->field($model, 'educational_organization')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'educated_between')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$(function(){
		$("#educationHistoryForm").submit(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var ID = $("#modelID").val();
			($("#isUpdateOrSave").val() == 1) ? changeEducation("create"):changeEducation("update&id="+ID);
			return false;	
		});
});

function changeEducation(theURL){
	var url = "index.php?r=departmenthead/educationhistory/"+theURL;
	
	var dataObject = $("#educationHistoryForm").serialize();
	
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		data:dataObject,
		success: function(responce){
				
		},
	});	
	
	$.get("index.php?r=departmenthead/educationhistory/index", function(data1){ $("#educationform").html(data1);});
	$("#modalCreate").modal("hide");
	
}

</script>