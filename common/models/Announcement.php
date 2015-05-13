<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property integer $id
 * @property string $subject
 * @property string $content
 * @property string $DateCreated
 * @property string $LastUpdate
 * @property integer $user_id
 *
 * @property User $user
 * @property AnnouncementState[] $announcementStates
 * @property AnnouncementVisibility[] $announcementVisibilities
 */
class Announcement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'content', 'DateCreated', 'user_id'], 'required'],
            [['content'], 'string'],
            [['DateCreated', 'LastUpdate'], 'safe'],
            [['user_id'], 'integer'],
            [['subject'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'content' => 'Content',
            'DateCreated' => 'Date Created',
            'LastUpdate' => 'Last Update',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementStates()
    {
        return $this->hasMany(AnnouncementState::className(), ['announcement_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnnouncementVisibilities()
    {
        return $this->hasMany(AnnouncementVisibility::className(), ['announcement_id' => 'id']);
    }
}
