<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Announcements';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <p>
        <?= Html::button('Create Announcement', ['class' => 'btn btn-success','onclick' => 'showCreateModal()']) ?>
        
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
    </p>
<?php Pjax::begin(['options' => ['class' => 'pjax-wrapper']]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject',
            'content:ntext',
			'status',
			'publicity',
            'date',
            'changed',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn',
				'template' => '{update} {delete}',
				'buttons' => [
					'update' => function($url,$model){
							$url = Url::to(['/advisor/announcement/update','id' => $model['id']]);
							return Html::button('<span class="glyphicon glyphicon-pencil"></span>', ['class' => '', 'onclick' => 'updateAnnouncement('.$model['id'].')']);
							/*return Html::a(
								<span class="glyphicon glyphicon-edit"></span>',
								"#",
								['title' => 'Edit', 'id' => $model['id'],'class' => 'grid-action','onclick' => 'showModal($(this).attr("id"))']
							);*/
						},
					'delete' => function($url,$model){
							$url = "#";
							return Html::a(
								'<span class="glyphicon glyphicon-trash"></span>',
								$url,
								['title' => 'Delete','class' => '','onclick'=>'deleteAnnouncement('.$model['id'].')']
							);
						},
				],
			],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php
	$this->registerJs('
		
	');
 ?>
<script>
function showModal(id){
	var csrfToken = $('meta[name="csrf-token"]').attr("content");
	$.get("/sduportal/frontend/web/index.php?r=advisor%2Fannouncement%2Fupdate",{id:id, _csrf: csrfToken},function(data){ $("#modal").modal("show").find("#modalContent").html(data); });
	//$("#modal").modal("show").find("#modalContent").html(id);	
}

function showCreateModal(){
	$.post("/sduportal/frontend/web/index.php?r=announcement%2Fcreate", function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data); });
}

function deleteAnnouncement(aid){
	//alert(aid);
	$.get("/sduportal/frontend/web/index.php?r=announcement%2Fdelete",{ id:aid}, function(data){ $.pjax.reload(".table table-striped table-bordered");});	
}

function updateAnnouncement(aid){
	$.get("/sduportal/frontend/web/index.php?r=announcement%2Fupdate",{ id:aid}, function(data){ $("#modal").modal("show").find("#modalContent").html(data);  });
}

</script>
</div>
