<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "education_history".
 *
 * @property integer $id
 * @property string $educational_organization
 * @property string $educated_between
 * @property string $address
 * @property integer $user_id
 *
 * @property User $user
 */
class EducationHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'education_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['educational_organization', 'educated_between', 'address', 'user_id'], 'required'],
            [['educational_organization', 'address'], 'string'],
            [['user_id'], 'integer'],
            [['educated_between'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'educational_organization' => 'Educational Organization',
            'educated_between' => 'Educated Between',
            'address' => 'Address',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
