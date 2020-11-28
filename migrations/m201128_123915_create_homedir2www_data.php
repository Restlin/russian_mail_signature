<?php

use yii\db\Migration;

/**
 * Class m201128_123915_create_homedir2www_data
 */
class m201128_123915_create_homedir2www_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $homeDir = Yii::getAlias('@app/home');
        if(!file_exists($homeDir)) {
            mkdir($homeDir);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $homeDir = Yii::getAlias('@app/home');
        if(file_exists($homeDir)) {
            yii\helpers\FileHelper::removeDirectory($homeDir);
        }
    }

}
