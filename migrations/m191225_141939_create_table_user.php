<?php

use yii\db\Migration;

/**
 * Class m191225_141939_create_table_user
 */
class m191225_141939_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->createTable('user', [
		    'id' => $this->primaryKey(),
		    'first_name' => $this->string(256)->notNull(),
		    'last_name' => $this->string(256)->notNull(),
		    'email' => $this->string(256)->notNull()->unique(),
		    'image' => $this->string('256'),
		    'balance' => $this->decimal(15, 4),
		    'login' => $this->string(256)->notNull()->unique(),
		    'password' => $this->string(256)->notNull(),
		    'auth_key' => $this->string(256)->notNull(),
	    ]);

	    $this->createIndex(
		    'idx-user-id',
		    'user',
		    'id'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropIndex(
		    'idx-user-id',
		    'user'
	    );

	    $this->dropTable('user');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191225_141939_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
