<?php

	namespace app\modules\services\models;

	use app\modules\user\models\query\UserQuery;
	use app\modules\user\models\User;
	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "order".
	 *
	 * @property int $id
	 * @property int $user_id
	 * @property int $service_id
	 * @property int $question_id
	 * @property int $answer_id
	 * @property int $comment_id
	 * @property string|null $created_at
	 * @property string|null $updated_at
	 *
	 * @property Answer $answer
	 * @property Comment $comment
	 * @property Question $question
	 * @property Service $service
	 * @property User $user
	 */
	class Order extends \yii\db\ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'order';
		}

		public function behaviors()
		{
			return [
				//Использование поведения TimestampBehavior ActiveRecord
				'timestamp' => [
					'class' => TimestampBehavior::className(),
					'attributes' => [
						\yii\db\BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
						\yii\db\BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],

					],
					//можно использовать 'value' => new \yii\db\Expression('NOW()'),
					'value' => function () {
						return gmdate("Y-m-d H:i:s");
					},


				],

			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['user_id', 'service_id', 'question_id', 'answer_id', 'comment_id'], 'required'],
				[['user_id', 'service_id', 'question_id', 'answer_id', 'comment_id'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['answer_id' => 'id']],
				[['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
				[['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
				[['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
				[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => Yii::t('app', 'ID'),
				'user_id' => Yii::t('app', 'User ID'),
				'service_id' => Yii::t('app', 'Service ID'),
				'question_id' => Yii::t('app', 'Question ID'),
				'answer_id' => Yii::t('app', 'Answer ID'),
				'comment_id' => Yii::t('app', 'Comment ID'),
				'created_at' => Yii::t('app', 'Created At'),
				'updated_at' => Yii::t('app', 'Updated At'),
			];
		}

		/**
		 * Gets query for [[Answer]].
		 *
		 * @return \yii\db\ActiveQuery|AnswerQuery
		 */
		public function getAnswer()
		{
			return $this->hasOne(Answer::className(), ['id' => 'answer_id'])->inverseOf('orders');
		}

		/**
		 * Gets query for [[Comment]].
		 *
		 * @return \yii\db\ActiveQuery|CommentQuery
		 */
		public function getComment()
		{
			return $this->hasOne(Comment::className(), ['id' => 'comment_id'])->inverseOf('orders');
		}

		/**
		 * Gets query for [[Question]].
		 *
		 * @return \yii\db\ActiveQuery|QuestionQuery
		 */
		public function getQuestion()
		{
			return $this->hasOne(Question::className(), ['id' => 'question_id'])->inverseOf('orders');
		}

		/**
		 * Gets query for [[Service]].
		 *
		 * @return \yii\db\ActiveQuery|ServiceQuery
		 */
		public function getService()
		{
			return $this->hasOne(Service::className(), ['id' => 'service_id'])->inverseOf('orders');
		}

		/**
		 * Gets query for [[User]].
		 *
		 * @return \yii\db\ActiveQuery|UserQuery
		 */
		public function getUser()
		{
			return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('orders');
		}

		/**
		 * {@inheritdoc}
		 * @return OrderQuery the active query used by this AR class.
		 */
		public static function find()
		{
			return new OrderQuery(get_called_class());
		}
	}
