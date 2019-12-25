<?php
	
	use yii\db\Migration;
	
	/**
	 * Handles the creation of table `{{%user}}`.
	 */
	class m191225_090554_create_user_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('{{%user}}', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'email' => $this->string()->notNull()->unique(),
				'passhash' => $this->string()->notNull()->unique(),
				'status' => $this->integer()->defaultValue(1)
			]);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('{{%user}}');
		}
	}
