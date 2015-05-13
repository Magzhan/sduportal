<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Education Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="education-history-index">
    <p>
        <?= Html::button('Create Education History', ['class' => 'btn btn-success', 'onclick' => 'showModal()']) ?>
    </p>
		<?php
			Modal::begin([
				'header' => '<h4>Update</h4>',
				'id' => 'modalUpdate',
				'size' => 'modal-lg',
			]);
			
			echo "<div id='modalContent'></div>";
			
			Modal::end();
			
			Modal::begin([
				'header' => '<h4>Create</h4>',
				'id' => 'modalCreate',
				'size' => 'modal-lg',
			]);
			
			echo "<div id='modalContent2'></div>";
			
			Modal::end();
		 ?>
    
<?php Pjax::begin(['options' => ['class' => 'pjax-wrapper']]); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'educational_organization:ntext',
            'educated_between',
            'address:ntext',

            ['class' => 'yii\grid\ActionColumn',
				'template' => '{edit} &nbsp; {delete}',
				'buttons' => [
					'edit' => function($url, $model){
						$url = '#';
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title'=>'Edit', 'data-pjax'=>'0','class'=>'','onclick'=>'updateEducation('.$model['id'].')']);
					},
					'delete' => function($url, $model){
						$url = '#';
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title'=>'Delete', 'data-pjax'=>'0','class'=>'','onclick'=>'deleteEducation('.$model['id'].')']);
					},
				],
			],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<script>
function showModal(){
	$.get("index.php?r=departmenthead/educationhistory/create", function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data);});
}

function updateEducation(eid){
	$.get("index.php?r=departmenthead/educationhistory/update", { id:eid}, function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data);});
}

function deleteEducation(eid){
	$.get("index.php?r=departmenthead/educationhistory/delete", {id:eid}, function(data){ $.get("index.php?r=departmenthead/educationhistory/index", function(data1){ $("#educationform").html(data1);});});
}

</script>