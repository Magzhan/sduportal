<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/modules/methodologist/views/layouts/main.php'); ?>
<div class="row">
    <div class="col-md-2 col-sm-3">
        <div class="list-group">
            <?php
            	
            ?>
        </div>
    </div>
    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); ?>