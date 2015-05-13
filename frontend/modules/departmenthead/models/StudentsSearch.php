<?php

namespace frontend\modules\departmenthead\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserData;
use yii\db\Query;
use backend\models\User;

/**
 * StudentsSearch represents the model behind the search form about `common\models\UserData`.
 */
class StudentsSearch extends UserData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'course', 'user_id', 'entry_year', 'document_number'], 'integer'],
            [['name', 'surname', 'gender', 'LastUpdate', 'education_level', 'payment_type', 'birthdate', 'mobile1', 'mobile2', 'email2', 'address', 'nationality', 'document_type', 'document_issue_date', 'document_expire_date', 'document_issue_organization'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {		
        //$query = UserData::find();
		

        $this->load($params);
		
		//print_r($params); die();
		
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'course' => $this->course,
            'LastUpdate' => $this->LastUpdate,
            'user_id' => $this->user_id,
            /*'faculty_id' => $this->faculty,
            'department_id' => $this->department,
            'group_id' => $this->group,*/
            'entry_year' => $this->entry_year,
            'birthdate' => $this->birthdate,
            'document_number' => $this->document_number,
            'document_issue_date' => $this->document_issue_date,
            'document_expire_date' => $this->document_expire_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'education_level', $this->education_level])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'mobile1', $this->mobile1])
            ->andFilterWhere(['like', 'mobile2', $this->mobile2])
            ->andFilterWhere(['like', 'email2', $this->email2])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'document_type', $this->document_type])
            ->andFilterWhere(['like', 'document_issue_organization', $this->document_issue_organization]);

        return $dataProvider;
    }
	
	protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
