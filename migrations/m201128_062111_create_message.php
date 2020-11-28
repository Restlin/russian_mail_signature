<?php

use yii\db\Migration;
use yii\db\ColumnSchemaBuilder;
use yii\base\NotSupportedException;

/**
 * Class m201128_062111_create_message
 */
class m201128_062111_create_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'id' => $this->primaryKey()->comment('ИД'),
            'message' => $this->text()->comment('Обращение'),
            'user_id' => $this->integer()->notNull()->comment('ID пользователя'),
            'status' => $this->integer()->notNull()->defaultValue(0)->comment('Статус обработки обращения'),
            'date_create' => $this->timestampWithTimezone()->comment('Дата создания'),
        ]);
        $this->addForeignKey('fk_message_user_id', 'message', ['user_id'], '"user"', ['id'], 'CASCADE', 'CASCADE');

        $this->createTable('message_file', [
            'message_id' => $this->integer()->notNull()->comment('ID обращения'),
            'file_id' => $this->integer()->notNull()->comment('ID файла'),
        ]);

        $this->addForeignKey('fk_message_file_message_id', 'message_file', ['message_id'], 'message', ['id'], 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_message_file_file_id', 'message_file', ['file_id'], 'file', ['id'], 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message_file');
        $this->dropTable('message');
    }

    /**
     * @param int|null $precision
     * @return ColumnSchemaBuilder
     * @throws NotSupportedException
     */
    private function timestampWithTimezone(int $precision = null): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('timestamp with time zone', $precision)->defaultExpression('CURRENT_TIMESTAMP');
    }
}
