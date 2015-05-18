<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div id="file_upload">
<?php $form = ActiveForm::begin([
			'id' => 'student_list_form',
			'ajaxDataType' => 'json',
			'ajaxParam' => 'ajax',
			'options' => ['enctype' => 'multipart/form-data']
		]); ?>
	
<?=   $form->field($model, 'file')->fileInput(); ?>

<?= Html::submitButton('Load', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
<?= Html::button('List', ['class' => 'btn btn-primary','onclick' => 'getList()']) ?>
</div>
<div id="students_list">
</div>
<script>

function getList(){
	$.get("index.php?r=departmenthead/students/loadstudentlist",function(data){ $("#students_list").html(data);});
}
</script>