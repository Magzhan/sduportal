<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property string $DateCreated
 * @property string $LastUpdate
 * @property integer $department_id
 *
 * @property AnnouncementVisibility[] $announcementVisibilities
 * @property Department $department
 * @property UserData[] $userDatas
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'DateCreated', 'department_id'], 'required'],
            [['DateCreated', 'LastUpdate'], 'safe'],
            [['department_id'], 'integer'],
            [['name'], 'string', 'max' => 45]
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
            'DateCreated' => 'Date Created',
            'LastUpdate' => 'Last Update',
            'department_id' => 'Department ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementVisibilities()
    {
        return $this->hasMany(AnnouncementVisibility::className(), ['group_id' => 'id']);
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
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['group_id' => 'id']);
    }
}
