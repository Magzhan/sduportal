<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\departmenthead\models\StudentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'course') ?>

    <?php // echo $form->field($model, 'LastUpdate') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'faculty_id') ?>

    <?php // echo $form->field($model, 'department_id') ?>

    <?php // echo $form->field($model, 'group_id') ?>

    <?php // echo $form->field($model, 'entry_year') ?>

    <?php // echo $form->field($model, 'education_level') ?>

    <?php // echo $form->field($model, 'payment_type') ?>

    <?php // echo $form->field($model, 'birthdate') ?>

    <?php // echo $form->field($model, 'mobile1') ?>

    <?php // echo $form->field($model, 'mobile2') ?>

    <?php // echo $form->field($model, 'email2') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'document_type') ?>

    <?php // echo $form->field($model, 'document_number') ?>

    <?php // echo $form->field($model, 'document_issue_date') ?>

    <?php // echo $form->field($model, 'document_expire_date') ?>

    <?php // echo $form->field($model, 'document_issue_organization') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
