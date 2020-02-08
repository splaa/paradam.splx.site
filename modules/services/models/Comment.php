<?php

	namespace app\modules\services\models;

	use Yii;
	use yii\behaviors\TimestampBehavior;

	/**
	 * This is the model class for table "comment".
	 *
	 * @property int $id
	 * @property int|null $order_id
	 * @property string|null $comment
	 * @property string|null $created_at
	 * @property string|null $updated_at
	 *
	 * @property Order[] $orders
	 */
	class Comment extends \yii\db\ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'comment';
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
				[['order_id'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
				[['comment'], 'string', 'max' => 255],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => Yii::t('app', 'ID'),
				'order_id' => Yii::t('app', 'Order ID'),
				'comment' => Yii::t('app', 'Comment'),
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
			return $this->hasMany(Order::className(), ['comment_id' => 'id'])->inverseOf('comment');
		}

		/**
		 * {@inheritdoc}
		 * @return CommentQuery the active query used by this AR class.
		 */
		public static function find()
		{
			return new CommentQuery(get_called_class());
		}
	}
