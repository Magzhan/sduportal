<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\AnnouncementPublicity;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Announcement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="announcement-form">

    <?php $form = ActiveForm::begin([
			'id' => 'announcement_form',
			'ajaxDataType' => 'json',
			'ajaxParam' => 'ajax',
			
			//'enableClientValidation' => false,
	]); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'publicity')->radioList(ArrayHelper::map(AnnouncementPublicity::find()->all(), 'id', 'name'), 
	[
		'id'=>'myradiolist',
		'onchange'=>'
			if($("input:radio[name=\'AnnouncementForm[publicity]\']:checked").val() == 2){ $.post( "index.php?r=announcement/list", function(data){ $("#visibility_groups").html(data);});}else{$("#visibility_groups").html("");}',
	]); ?>
	<div id="visibility_groups"></div>
    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$("#announcement_form").submit(function(e){
		e.preventDefault();
		e.stopImmediatePropagation();
		signup();
		return false;
	});


function signup(){
	var url = "/sduportal/frontend/web/index.php?r=announcement%2Fcreate";
	
	var dataObject = $("#announcement_form").serialize();
	
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		data:dataObject,
		success:function(response){
			
		},	
	});
		$("#modalCreate").modal("hide");
}
</script>