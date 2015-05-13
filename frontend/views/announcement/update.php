<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Announcement */

$this->title = 'Update Announcement: ' . ' ' . $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Announcements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['view', 'id' => $model->subject]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="announcement-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form2', [
        'model' => $model,
    ]) ?>

</div>
