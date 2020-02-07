<?php

	namespace app\modules\services\models;

	use yii\base\Model;
	use yii\data\ActiveDataProvider;

	/**
	 * OrderSearch represents the model behind the search form of `app\modules\services\models\Order`.
	 */
	class OrderSearch extends Order
	{
		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['id', 'user_id', 'service_id', 'question_id', 'answer_id', 'comment_id'], 'integer'],
				[['created_at', 'updated_at'], 'safe'],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function scenarios()
		{
			// bypass scenarios() implementation in the parent class
			return Model::scenarios();
		}

		/**
		 * Creates data provider instance with search query applied
		 *
		 * @param array $params
		 *
		 * @return ActiveDataProvider
		 */
		public function search($params)
		{
			$query = Order::find();

			// add conditions that should always apply here

			$dataProvider = new ActiveDataProvider([
				'query' => $query,
			]);

			$this->load($params);

			if (!$this->validate()) {
				// uncomment the following line if you do not want to return any records when validation fails
				// $query->where('0=1');
				return $dataProvider;
			}

			// grid filtering conditions
			$query->andFilterWhere([
				'id' => $this->id,
				'user_id' => $this->user_id,
				'service_id' => $this->service_id,
				'question_id' => $this->question_id,
				'answer_id' => $this->answer_id,
				'comment_id' => $this->comment_id,
				'created_at' => $this->created_at,
				'updated_at' => $this->updated_at,
			]);

			return $dataProvider;
		}
	}
