<?php

namespace app\modules\message\models;

use Yii;

/**
 * This is the model class for table "thread".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Message[] $messages
 * @property UserThread[] $userThreads
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'thread';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::className(), ['thread_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserThreads()
    {
        return $this->hasMany(UserThread::className(), ['thread_id' => 'id']);
    }
}
