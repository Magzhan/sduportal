<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'male' => 'Male', 'female' => 'Female', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'course')->textInput() ?>

    <?= $form->field($model, 'LastUpdate')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'faculty_id')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'entry_year')->textInput() ?>

    <?= $form->field($model, 'education_level')->dropDownList([ 'bachelor' => 'Bachelor', 'master' => 'Master', 'ph.d' => 'Ph.d', ], ['prompt' => '']) ?>

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
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
