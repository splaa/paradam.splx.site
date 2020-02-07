<?php

	use yii\db\Migration;

	/**
	 * Handles the creation of table `{{%order}}`.
	 * Has foreign keys to the tables:
	 *
	 * - `{{%user}}`
	 * - `{{%service}}`
	 * - `{{%question}}`
	 * - `{{%answer}}`
	 * - `{{%comment}}`
	 */
	class m200207_185017_create_order_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('{{%order}}', [
				'id' => $this->primaryKey(),
				'user_id' => $this->integer()->notNull(),
				'service_id' => $this->integer()->notNull(),
				'question_id' => $this->integer()->notNull(),
				'answer_id' => $this->integer()->notNull(),
				'comment_id' => $this->integer()->notNull(),
				'created_at' => $this->dateTime(),
				'updated_at' => $this->dateTime(),
			]);

			// creates index for column `user_id`
			$this->createIndex(
				'{{%idx-order-user_id}}',
				'{{%order}}',
				'user_id'
			);

			// add foreign key for table `{{%user}}`
			$this->addForeignKey(
				'{{%fk-order-user_id}}',
				'{{%order}}',
				'user_id',
				'{{%user}}',
				'id',
				'CASCADE'
			);

			// creates index for column `service_id`
			$this->createIndex(
				'{{%idx-order-service_id}}',
				'{{%order}}',
				'service_id'
			);

			// add foreign key for table `{{%service}}`
			$this->addForeignKey(
				'{{%fk-order-service_id}}',
				'{{%order}}',
				'service_id',
				'{{%service}}',
				'id',
				'CASCADE'
			);

			// creates index for column `question_id`
			$this->createIndex(
				'{{%idx-order-question_id}}',
				'{{%order}}',
				'question_id'
			);

			// add foreign key for table `{{%question}}`
			$this->addForeignKey(
				'{{%fk-order-question_id}}',
				'{{%order}}',
				'question_id',
				'{{%question}}',
				'id',
				'CASCADE'
			);

			// creates index for column `answer_id`
			$this->createIndex(
				'{{%idx-order-answer_id}}',
				'{{%order}}',
				'answer_id'
			);

			// add foreign key for table `{{%answer}}`
			$this->addForeignKey(
				'{{%fk-order-answer_id}}',
				'{{%order}}',
				'answer_id',
				'{{%answer}}',
				'id',
				'CASCADE'
			);

			// creates index for column `comment_id`
			$this->createIndex(
				'{{%idx-order-comment_id}}',
				'{{%order}}',
				'comment_id'
			);

			// add foreign key for table `{{%comment}}`
			$this->addForeignKey(
				'{{%fk-order-comment_id}}',
				'{{%order}}',
				'comment_id',
				'{{%comment}}',
				'id',
				'CASCADE'
			);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			// drops foreign key for table `{{%user}}`
			$this->dropForeignKey(
				'{{%fk-order-user_id}}',
				'{{%order}}'
			);

			// drops index for column `user_id`
			$this->dropIndex(
				'{{%idx-order-user_id}}',
				'{{%order}}'
			);

			// drops foreign key for table `{{%service}}`
			$this->dropForeignKey(
				'{{%fk-order-service_id}}',
				'{{%order}}'
			);

			// drops index for column `service_id`
			$this->dropIndex(
				'{{%idx-order-service_id}}',
				'{{%order}}'
			);

			// drops foreign key for table `{{%question}}`
			$this->dropForeignKey(
				'{{%fk-order-question_id}}',
				'{{%order}}'
			);

			// drops index for column `question_id`
			$this->dropIndex(
				'{{%idx-order-question_id}}',
				'{{%order}}'
			);

			// drops foreign key for table `{{%answer}}`
			$this->dropForeignKey(
				'{{%fk-order-answer_id}}',
				'{{%order}}'
			);

			// drops index for column `answer_id`
			$this->dropIndex(
				'{{%idx-order-answer_id}}',
				'{{%order}}'
			);

			// drops foreign key for table `{{%comment}}`
			$this->dropForeignKey(
				'{{%fk-order-comment_id}}',
				'{{%order}}'
			);

			// drops index for column `comment_id`
			$this->dropIndex(
				'{{%idx-order-comment_id}}',
				'{{%order}}'
			);

			$this->dropTable('{{%order}}');
		}
	}
