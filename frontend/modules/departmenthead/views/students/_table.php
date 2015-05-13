<div class="user-data-index">

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            //'id',
            'name',
            'surname',
            //'gender',
            'course',
            // 'LastUpdate',
            // 'user_id',
            'faculty',
            'department',
            'group',
            // 'entry_year',
            // 'education_level',
            // 'payment_type',
            'birthdate',
            // 'mobile1',
            // 'mobile2',
            'email',
            // 'address:ntext',
            // 'nationality',
            // 'document_type',
            // 'document_number',
            // 'document_issue_date',
            // 'document_expire_date',
            // 'document_issue_organization:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>