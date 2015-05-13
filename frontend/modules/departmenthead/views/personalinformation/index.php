<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personal-information-index">
    <p>
        <?= Html::button('Create Personal Information', ['class' => 'btn btn-success','onclick' => 'showModal()']) ?>
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

            //'id',
            'name',
            'surname',
            'gender',
            'relationship',
            'workplace',
            'mobile',
            'phone',
            'address:ntext',
            'email:email',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn',
				'template' => '{edit} &nbsp; {delete}',
				'buttons' => [
					'edit' => function($url, $model){
						$url = '#';
						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title'=>'Edit', 'data-pjax'=>'0','class'=>'','onclick'=>'updatePersonalInformation('.$model['id'].')']);
					},
					'delete' => function($url, $model){
						$url = '#';
						return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title'=>'Delete', 'data-pjax'=>'0','class'=>'','onclick'=>'deletePersonalInformation('.$model['id'].')']);
					},
				],
			],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<script>
function showModal(){
	$.get("index.php?r=departmenthead/personalinformation/create", function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data);});	
}

function updatePersonalInformation(pid){
	$.get("index.php?r=departmenthead/personalinformation/update", {id:pid}, function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data);});
}

function deletePersonalInformation(pid){
	$.get("index.php?r=departmenthead/personalinformation/delete", {id:pid}, function(data){ $.get("index.php?r=departmenthead/personalinformation/index", function(data1){ $("#relativesform").html(data1); });});
}
</script>