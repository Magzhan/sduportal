<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/modules/student/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-2 col-sm-3">
        <div class="list-group">
            <ul>
            	<li><?php echo Html::a('profile', Url::toRoute('default/profile')); ?></li>
                <li><?php echo Html::a('my announcements', Url::toRoute('announcement/index')); ?></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
<script>
$(window).scroll(function(){
		$(".list-group").stop().animate({"marginTop": ($(window).scrollTop() + 5) + "px"}, "fast");
	});
var menu_hidden = true;

function studentMenu(){
	if(menu_hidden){
		$("#students_submenu").show();
	}else{
		$("#students_submenu").hide();
	}
	menu_hidden = !menu_hidden;	
}
</script>