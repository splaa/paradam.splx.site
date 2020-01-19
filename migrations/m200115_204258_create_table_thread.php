<?php

use yii\db\Migration;

/**
 * Class m200115_204258_create_table_thread
 */
class m200115_204258_create_table_thread extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    	// DROP TABLE message
	    $this->dropForeignKey(
		    'fk-message-id_sender',
		    'message'
	    );

	    $this->dropForeignKey(
		    'fk-message-id_recipient',
		    'message'
	    );

	    $this->dropForeignKey(
		    'fk-message-id_service',
		    'message'
	    );

	    $this->dropIndex(
		    'idx-message-id',
		    'message'
	    );

	    $this->dropIndex(
		    'idx-message-id_sender',
		    'message'
	    );

	    $this->dropIndex(
		    'idx-message-id_recipient',
		    'message'
	    );

	    $this->dropIndex(
		    'idx-message-id_service',
		    'message'
	    );

	    $this->dropTable('message');

	    // Create new Table
	    $tableOptions = null;
	    if ($this->db->driverName === 'mysql') {
		    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
	    }

	    $this->createTable('{{%thread}}', [
		    'id' => $this->primaryKey(),
		    'title' => $this->string(),
		    'created_at' => $this->dateTime()
	    ], $tableOptions);

	    $this->createIndex(
		    'idx-thread-id',
		    'thread',
		    'id'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    	$this->dropIndex('idx-thread-id', '{{%thread}}');
    	$this->dropTable('{{%thread}}');

	    $this->createTable('message', [
		    'id' => $this->primaryKey(),
		    'id_sender' => $this->integer(11),
		    'id_recipient' => $this->integer(11),
		    'id_service' => $this->integer(11),
		    'message' => $this->text(),
		    'created_at' => $this->dateTime()
	    ]);

	    $this->createIndex(
		    'idx-message-id',
		    'message',
		    'id'
	    );

	    $this->createIndex(
		    'idx-message-id_sender',
		    'message',
		    'id_sender'
	    );

	    $this->createIndex(
		    'idx-service-id_recipient',
		    'message',
		    'id_recipient'
	    );

	    $this->createIndex(
		    'idx-message-id_service',
		    'message',
		    'id_service'
	    );

	    $this->addForeignKey(
		    'fk-message-id_sender',
		    'message',
		    'id_sender',
		    'user',
		    'id',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'fk-message-id_recipient',
		    'message',
		    'id_recipient',
		    'user',
		    'id',
		    'CASCADE'
	    );

	    $this->addForeignKey(
		    'fk-message-id_service',
		    'message',
		    'id_service',
		    'service',
		    'id',
		    'CASCADE'
	    );
    }
}
