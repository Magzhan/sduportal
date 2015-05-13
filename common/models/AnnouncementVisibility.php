<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "announcement_visibility".
 *
 * @property integer $id
 * @property integer $announcement_id
 * @property integer $group_id
 *
 * @property Announcement $announcement
 * @property Group $group
 */
class AnnouncementVisibility extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'announcement_visibility';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['announcement_id', 'group_id'], 'required'],
            [['announcement_id', 'group_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'announcement_id' => 'Announcement ID',
            'group_id' => 'Group ID',
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
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
