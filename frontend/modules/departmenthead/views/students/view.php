<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserData */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'gender',
            'course',
            'LastUpdate',
            'user_id',
            'faculty_id',
            'department_id',
            'group_id',
            'entry_year',
            'education_level',
            'payment_type',
            'birthdate',
            'mobile1',
            'mobile2',
            'email2:email',
            'address:ntext',
            'nationality',
            'document_type',
            'document_number',
            'document_issue_date',
            'document_expire_date',
            'document_issue_organization:ntext',
        ],
    ]) ?>

</div>
