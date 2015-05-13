<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PersonalInformation */
/* @var $form ActiveForm */
?>
<div class="form5">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'gender') ?>
        <?= $form->field($model, 'relationship') ?>
        <?= $form->field($model, 'address') ?>
        <?= $form->field($model, 'workplace') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'mobile') ?>
        <?= $form->field($model, 'phone') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form5 -->
