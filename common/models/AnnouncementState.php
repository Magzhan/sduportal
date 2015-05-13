<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement_state".
 *
 * @property integer $id
 * @property string $DateCreated
 * @property string $LastUpdate
 * @property integer $announcement_id
 * @property integer $announcement_publicity_id
 * @property integer $announcement_condition_id
 * @property integer $user_id
 *
 * @property Announcement $announcement
 * @property AnnouncementCondition $announcementCondition
 * @property AnnouncementPublicity $announcementPublicity
 * @property User $user
 */
class AnnouncementState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DateCreated', 'announcement_id', 'announcement_publicity_id', 'announcement_condition_id', 'user_id'], 'required'],
            [['DateCreated', 'LastUpdate'], 'safe'],
            [['announcement_id', 'announcement_publicity_id', 'announcement_condition_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'DateCreated' => 'Date Created',
            'LastUpdate' => 'Last Update',
            'announcement_id' => 'Announcement ID',
            'announcement_publicity_id' => 'Announcement Publicity ID',
            'announcement_condition_id' => 'Announcement Condition ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncement()
    {
        return $this->hasOne(Announcement::className(), ['id' => 'announcement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementCondition()
    {
        return $this->hasOne(AnnouncementCondition::className(), ['id' => 'announcement_condition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementPublicity()
    {
        return $this->hasOne(AnnouncementPublicity::className(), ['id' => 'announcement_publicity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
