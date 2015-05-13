<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PersonalInformation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personal-information-form">

    <?php $form = ActiveForm::begin([
		'id' => 'relativesInformationForm',
	]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>
	<input type="hidden" value="<?php echo $model->isNewRecord; ?>" id="isSaveOrUpdate"/>
    <input type="hidden" value="<?php echo $model->id; ?>" id="modelID"/>
    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'relationship')->dropDownList([ 'father' => 'Father', 'mother' => 'Mother', 'grandfather' => 'Grandfather', 'grandmother' => 'Grandmother', 'sibling' => 'Sibling', 'husband' => 'Husband', 'wife' => 'Wife', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'workplace')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$(function(){
		$("#relativesInformationForm").submit(function(e){
			e.preventDefault();
			e.stopImmediatePropagation();
			var ID = $("#modelID").val(); 
			($("#isSaveOrUpdate").val() == 1) ? enterNewData("create"):enterNewData("update&id="+ID);
			return false;
		});
});

function enterNewData(theURL){
	
	url = "index.php?r=departmenthead/personalinformation/"+theURL;
	
	dataObject = $("#relativesInformationForm").serialize();
	
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		data:dataObject,
		success: function(responce){
			
		},	
	});	
	
	$.get("index.php?r=departmenthead/personalinformation/index", function(data1){ $("#relativesform").html(data1);});
	$("#modalCreate").modal("hide");
}
</script>