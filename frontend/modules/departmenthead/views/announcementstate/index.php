<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcement States';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
	$this->registerJs('$(function(){
			$("body").on("click", ".grid-action", function(e){
					var href = $(this).attr("href");
					var self = this;
					$.get(href, function(){
							var pjax_id = $(self).closest(".pjax-wrapper").attr("id");
							$.pjax.reload("#" + pjax_id);
						});
						return false;
				});
		});');
 ?>
<div class="announcement-state-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    	<?php
			Modal::begin([
				'header' => '<h4>Update</h4>',
				'id' => 'modal',
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
        <?= Html::button('Create Announcement', ['class' => 'btn btn-success','onclick' => 'showCreateModal()']) ?>
		<?php $mod = []; ?>
    </p>
<?php Pjax::begin(['options' => ['class' => 'pjax-wrapper']]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'subject',
			'content:ntext',
			'condition',
			'name',
			'surname',
			'date',
			
            ['class' => 'yii\grid\ActionColumn',
				'template' => '{accept} {decline} &nbsp; {edit} &nbsp; {delete}',
				'buttons' => [
					'accept' => function($url,$model){
							//print_r($model); die();
							//echo $model->announcement_id; die();
							$url = Url::toRoute(['/departmenthead/announcementstate/accept', 'id' => $model['id']]);
							if($model['condition'] === 'rejected' || $model['condition'] === 'not checked')
							return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, ['title'=>'Accept','data-pjax'=>'0','class'=>'grid-action']);
							return null;
						},
					'decline' => function($url,$model){
							$url = Url::toRoute(['/departmenthead/announcementstate/decline', 'id' => $model['id']]);
							if($model['condition'] === 'posted')
							return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, ['title'=>'Decline','data-pjax'=>'0','class'=>'grid-action']);
							return null;
						},
					'edit' => function($url, $model){
							$url = "#";
							if($model['user_id'] == Yii::$app->user->identity->id){
								return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title'=>'Edit', 'data-pjax'=>'0','class'=>'','onclick'=>'updateAnnouncement('.$model['id'].')']);
							}
							return null;
						},
					'delete' => function($url, $model){
							$url = "#";
							if($model['user_id'] == Yii::$app->user->identity->id){
								return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title'=>'Edit', 'data-pjax'=>'0','class'=>'','onclick'=>'deleteAnnouncement('.$model['id'].')']);
							}
							return null;
					}		
				],
			],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<script>
function updateAnnouncement(aid){
	//alert(aid);
	$.get("index.php?r=announcement%2Fupdate",{ id:aid}, function(data){ $("#modal").modal("show").find("#modalContent").html(data);});	
}

function deleteAnnouncement(aid){
	//alert(aid);
	$.get("index.php?r=announcement%2Fdelete",{ id:aid}, function(data){ $.pjax.reload(".pjax-wrapper");});	
}

function showCreateModal(){
	$.post("index.php?r=announcement%2Fcreate", function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data); });
}
</script>