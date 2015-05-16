<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form ActiveForm */
?>
<div class="form3">

    <?php $form = ActiveForm::begin([
		'id' => 'primary_info_form',
	]); ?>

        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'displayname') ?>
        <?= $form->field($model, 'password_hash') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form3 -->
<script>
$(function(){
		$("#primary_info_form").submit(function(e){
				e.preventDefault();
				e.stopImmediatePropagation();
				enterPrimaryData();
				return false;
			});
});

function enterPrimaryData(){
	var url = "/sduportal/frontend/web/index.php?r=departmenthead/default/primaryinfo";
	
	var dataObject = $("#primary_info_form").serialize();
	
	$.ajax({
		url:url,
		type:"POST",
		dataType:"json",
		data:dataObject,
		success: function(){
			
		}
	});	
}
</script>