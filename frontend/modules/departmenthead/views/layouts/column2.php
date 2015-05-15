<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/modules/departmenthead/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-2 col-sm-3">
        <div class="list-group">
            <ul>
				<li><?php echo Html::a('index', Url::toRoute('default/index')); ?></li>
                <li><?php echo Html::a('profile', Url::toRoute('default/profile')); ?></li>
                <li onClick="studentMenu()"><?php echo Html::a('students', '#'); ?></li>
                <ul id="students_submenu" hidden="true">
                	<li><?php echo Html::a('All Students', Url::toRoute('students/index')); ?></li>
                	<li><?php echo Html::a('Add Student', Url::toRoute('students/addstudent')); ?></li>
                    <li><?php echo Html::a('Add Group', Url::toRoute('/')); ?></li>
                </ul>
            </ul>
        </div>
    </div>
    <div class="col-md-9 col-sm-8" id="my">
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

function addStudentModal(){
	
}
</script>