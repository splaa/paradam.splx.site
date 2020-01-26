<?php

namespace app\modules\message\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "thread".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $created_at
 *
 * @property Message[] $messages
 * @property Message[] $message
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

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
				],
				'value' => new Expression('NOW()'),
			]
		];
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
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['thread_id' => 'id'])->orderBy('created_at desc');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserThreads()
    {
        return $this->hasMany(UserThread::className(), ['thread_id' => 'id']);
    }
}
