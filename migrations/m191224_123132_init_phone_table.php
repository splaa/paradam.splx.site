<?php
	
	use yii\db\Migration;
	
	/**
	 * Class m191224_123132_init_phone_table
	 */
	class m191224_123132_init_phone_table extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable(
				'phone',
				[
					'id' => 'pk',
					'customer_id' => 'int unique',
					'number' => 'string',
				],
				'ENGINE=InnoDB'
			);
			$this->addForeignKey('customer_phone_numbers', 'phone',
				'customer_id', 'customer', 'id');
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			//отменяем в обратном порядке
			$this->dropForeignKey('customer_phone_numbers', 'phone');
			$this->dropTable('phone');
			echo "m191224_123132_init_phone_table drop phone table\n";
		}
		
		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{
	
		}
	
		public function down()
		{
			echo "m191224_123132_init_phone_table cannot be reverted.\n";
	
			return false;
		}
		*/
	}
