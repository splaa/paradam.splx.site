<?php

	namespace app\modules\services\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "answer".
	 *
	 * @property int $id
	 * @property int|null $question_id
	 * @property int|null $order_id
	 * @property string|null $answer
	 * @property string|null $created_at
	 * @property string|null $updated_at
	 *
	 * @property Order[] $orders
	 */
	class Answer extends \yii\db\ActiveRecord
	{
		public array $answers = [];

		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'answer';
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
				[['question_id', 'order_id'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['answer'], 'string', 'max' => 255],
				['answers', 'safe']
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => Yii::t('app', 'ID'),
				'question_id' => Yii::t('app', 'Question ID'),
				'order_id' => Yii::t('app', 'Order ID'),
				'answer' => Yii::t('app', 'Answer'),
				'created_at' => Yii::t('app', 'Created At'),
				'updated_at' => Yii::t('app', 'Updated At'),
			];
		}

		/**
		 * Gets query for [[Orders]].
		 *
		 * @return \yii\db\ActiveQuery|OrderQuery
		 */
		public function getOrders()
		{
			return $this->hasMany(Order::className(), ['answer_id' => 'id'])->inverseOf('answer');
		}

		/**
		 * {@inheritdoc}
		 * @return AnswerQuery the active query used by this AR class.
		 */
		public static function find()
		{
			return new AnswerQuery(get_called_class());
		}
	}
