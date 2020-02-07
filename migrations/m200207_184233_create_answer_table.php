<?php

	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%answer}}`.
	 */
	class m200207_184233_create_answer_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('{{%answer}}', [
				'id' => $this->primaryKey(),
				'question_id' => $this->integer(),
				'order_id' => $this->integer(),
				'answer' => $this->string(),
				'created_at' => $this->dateTime(),
				'updated_at' => $this->dateTime(),

			]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('{{%answer}}');
		}
	}
