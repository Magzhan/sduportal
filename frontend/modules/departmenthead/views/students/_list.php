<?php 
use yii\grid\GridView;
?>
<?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'A',
            'B',
            'C',
			'D',

            ['class' => 'yii\grid\ActionColumn',
			],
        ],
    ]); ?>