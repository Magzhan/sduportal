<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement_publicity".
 *
 * @property integer $id
 * @property string $name
 * @property string $DateCreated
 * @property string $LastUpdate
 *
 * @property AnnouncementState[] $announcementStates
 */
class AnnouncementPublicity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement_publicity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'DateCreated'], 'required'],
            [['DateCreated', 'LastUpdate'], 'safe'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementStates()
    {
        return $this->hasMany(AnnouncementState::className(), ['announcement_publicity_id' => 'id']);
    }
}
