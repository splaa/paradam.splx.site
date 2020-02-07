<?php

	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%comment}}`.
	 */
	class m200207_183105_create_comment_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('{{%comment}}', [
				'id' => $this->primaryKey(),
				'order_id' => $this->integer(),
				'comment' => $this->string(),
				'created_at' => $this->dateTime(),
				'updated_at' => $this->dateTime(),
			]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('{{%comment}}');
		}
	}
