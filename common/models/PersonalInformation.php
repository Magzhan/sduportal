<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "personal_information".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $relationship
 * @property string $workplace
 * @property string $mobile
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property integer $user_id
 *
 * @property User $user
 */
class PersonalInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'gender', 'relationship', 'user_id'], 'required'],
            [['gender', 'relationship', 'address'], 'string'],
            [['user_id'], 'integer'],
            [['name', 'surname', 'workplace', 'email'], 'string', 'max' => 255],
            [['mobile', 'phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'gender' => 'Gender',
            'relationship' => 'Relationship',
            'workplace' => 'Workplace',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'address' => 'Address',
            'email' => 'Email',
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
