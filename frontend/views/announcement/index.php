<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AnnouncementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Announcements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="announcement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php 
			Modal::begin([
				'header' => '<h4>Create</h4>',
				'id' => 'modalCreate',
				'size' => 'modal-lg',
			]);
			
			echo "<div id='modalContent2'></div>";
			
			Modal::end();
	?>
    <p>
        <?= Html::button('Create Announcement', ['class' => 'btn btn-success', 'onclick' => 'showCreateModal()']) ?>
    </p>

    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
		'layout' => '{items}{pager}',
        'itemView' => '_listItem',
    ]); ?>
	
    
</div>
<script>
function showCreateModal(){
	$.post("/sduportal/frontend/web/index.php?r=announcement%2Fcreate", function(data){ $("#modalCreate").modal("show").find("#modalContent2").html(data); });
}
</script>