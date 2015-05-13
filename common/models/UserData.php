<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_data".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property integer $course
 * @property string $LastUpdate
 * @property integer $user_id
 * @property integer $faculty_id
 * @property integer $department_id
 * @property integer $group_id
 * @property integer $entry_year
 * @property string $education_level
 * @property string $payment_type
 * @property string $birthdate
 * @property string $mobile1
 * @property string $mobile2
 * @property string $email2
 * @property string $address
 * @property string $nationality
 * @property string $document_type
 * @property integer $document_number
 * @property string $document_issue_date
 * @property string $document_expire_date
 * @property string $document_issue_organization
 *
 * @property Department $department
 * @property Group $group
 * @property User $user
 * @property Faculty $faculty
 */
class UserData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'gender', 'user_id', 'faculty_id', 'department_id', 'group_id'], 'required'],
            [['gender', 'education_level', 'payment_type', 'address', 'document_type', 'document_issue_organization'], 'string'],
            [['course', 'user_id', 'faculty_id', 'department_id', 'group_id', 'entry_year', 'document_number'], 'integer'],
            [['LastUpdate', 'birthdate', 'document_issue_date', 'document_expire_date'], 'safe'],
            [['name', 'surname', 'email2', 'nationality'], 'string', 'max' => 255],
            [['mobile1', 'mobile2'], 'string', 'max' => 20]
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
            'course' => 'Course',
            'LastUpdate' => 'Last Update',
            'user_id' => 'User ID',
            'faculty_id' => 'Faculty ID',
            'department_id' => 'Department ID',
            'group_id' => 'Group ID',
            'entry_year' => 'Entry Year',
            'education_level' => 'Education Level',
            'payment_type' => 'Payment Type',
            'birthdate' => 'Birthdate',
            'mobile1' => 'Mobile1',
            'mobile2' => 'Mobile2',
            'email2' => 'Email2',
            'address' => 'Address',
            'nationality' => 'Nationality',
            'document_type' => 'Document Type',
            'document_number' => 'Document Number',
            'document_issue_date' => 'Document Issue Date',
            'document_expire_date' => 'Document Expire Date',
            'document_issue_organization' => 'Document Issue Organization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
