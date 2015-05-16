<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EducationHistory */
/* @var $form ActiveForm */
?>
<div class="form4">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'educational_organization') ?>
        <?= $form->field($model, 'educated_between') ?>
        <?= $form->field($model, 'address') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form4 -->
