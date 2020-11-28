<?php

use yii\db\Migration;

/**
 * Class m201128_063855_modify_file_table
 */
class m201128_063855_modify_file_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('{{%file}}', 'sign', $this->text()->comment('Подпись'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('{{%file}}', 'sign');
    }

}
