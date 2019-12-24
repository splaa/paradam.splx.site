<?php
	
	use yii\db\Migration;
	
	/**
	 * Class m191224_121136_init_customer_table
	 */
	class m191224_121136_init_customer_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable(
				'customer',
				[
					'id' => 'pk',
					'name' => 'string',
					'birth_date' => 'date',
					'notes' => 'text',
				],
				'ENGINE=InnoDB'
			);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('customer');
			echo "m191224_121136_init_customer_table drop table customer.\n";
		}
		
		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{
	
		}
	
		public function down()
		{
			echo "m191224_121136_init_customer_table cannot be reverted.\n";
	
			return false;
		}
		*/
	}
