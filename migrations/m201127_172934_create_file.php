<?php

use yii\db\Migration;
use yii\db\ColumnSchemaBuilder;
use yii\base\NotSupportedException;

/**
 * Class m201127_172934_create_file
 */
class m201127_172934_create_file extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey()->comment('ID Файла'),
            'name' => $this->string()->notNull()->comment('Наименование файла'),
            'mime' => $this->string()->notNull()->comment('MIME тип'),
            'size' => $this->bigInteger()->notNull()->defaultValue(0)->comment('Размер'),
            'status' => $this->integer()->notNull()->defaultValue(0)->comment('Статус обработки файла'),
            'date_start' => $this->timestampWithTimezone()->comment('Дата начала парсинга'),
            'date_end' => $this->timestampWithTimezone()->comment('Дата завершения парсинга'),
        ]);

        if (!file_exists('files')) {
            mkdir('files');
            chmod('files', 0777);
        }

        $this->addColumn('{{%file}}', 'user_id', $this->integer()->notNull()->comment('ID пользователя'));
        $this->addForeignKey('fk_file_user_id', '{{%file}}', ['user_id'], '"user"', ['id'], 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file}}');
    }

    /**
     * @param int|null $precision
     * @return ColumnSchemaBuilder
     * @throws NotSupportedException
     */
    private function timestampWithTimezone(int $precision = null): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder('timestamp with time zone', $precision)->defaultExpression('NULL');
    }
}
