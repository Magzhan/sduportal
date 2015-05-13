<?php 

use yii\helpers\Html;


?>
<div id="main">
<div id="primaryinfo">
        <span id="b3"><?= Html::button('Edit', ['class' => 'btn btn-primary','onclick' => 'editPrimaryData()']) ?></span>
        <?= Html::button('View', ['class' => 'btn btn-primary','onclick' => 'view()']) ?>
        <h4>Primary Information</h4>
        <div id="primaryinfoform">
        </div>
</div>
<div id="personalinfo">
		<?php if(!$model): ?>
        <span id="b2"><?= Html::button('Fill', ['class' => 'btn btn-primary','onclick' => 'fill()']) ?></span>
        <?php else: ?>
        <span id="b1"><?= Html::button('Edit', ['class' => 'btn btn-primary','onclick' => 'editPersonalData()']) ?></span>
        <?= Html::button('View', ['class' => 'btn btn-primary','onclick' => 'view1()']) ?>
        <?php endif ?>
        <h4>Personal Information</h4>
	<div id="personalinfoform">
    </div>
</div>
<div id="education">
		<span id="b4"><?= Html::button('View', ['class' => 'btn btn-primary','onclick' => 'viewEducation()']) ?></span>
	<h4>Education History</h4>
	<div id="educationform"></div>
</div>
<div id="relatives">
		<span id="b5"><?= Html::button('View', ['class' => 'btn btn-primary','onclick' => 'viewRelatives()']) ?></span>
	<h4>Relatives</h4>
	<div id="relativesform"></div>
</div>
</div>
<script>
function editPrimaryData(){
	$.get("index.php?r=departmenthead/default/primaryinfo", function(data){ $("#primaryinfoform").html(data); $("#b3").html("<input type='button' onclick='hidePrimaryData()' class='btn btn-primary' value='Hide'/>");});
}

function hidePrimaryData(){
	$("#primaryinfoform").html("");
	$("#b3").html("<input type='button' onclick='editPrimaryData()' class='btn btn-primary' value='Edit'/>");
}

function editPersonalData(){
	$.get("index.php?r=departmenthead/default/update", function(data){ $("#personalinfoform").html(data); $("#b1").html("<input type='button' onclick='hidePersonalData()' class='btn btn-primary' value='Hide'/>");});
}

function hidePersonalData(){
	$("#personalinfoform").html("");
	$("#b1").html("<input type='button' onclick='editPersonalData()' class='btn btn-primary' value='Edit'/>");
}

function viewEducation(){
	$.get("index.php?r=departmenthead/educationhistory/index", function(data){ $("#educationform").html(data); $("#b4").html("<input type='button' onclick='hideEducation()' class='btn btn-primary' value='Hide'/>");});
}

function hideEducation(){
	$("#educationform").html("");
	$("#b4").html("<input type='button' onclick='viewEducation()' class='btn btn-primary' value='View'/>");
}

function viewRelatives(){
	$.get("index.php?r=departmenthead/personalinformation/index", function(data){ $("#relativesform").html(data); $("#b5").html("<input type='button' onclick='hideRelatives()' class='btn btn-primary' value='Hide'/>");});
}

function hideRelatives(){
	$("#relativesform").html("");
	$("#b5").html("<input type='button' onclick='viewRelatives()' class='btn btn-primary' value='View'/>");
}

</script>