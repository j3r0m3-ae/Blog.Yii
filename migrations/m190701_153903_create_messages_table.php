<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m190701_153903_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'author' => $this->string(255)->notNull(),
            'date' => $this->integer()->notNull(),
            'message' => $this->text()->notNull(),
            'path_to_file' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%messages}}');
    }
}
