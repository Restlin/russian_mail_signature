<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $id ИД
 * @property string|null $message Обращение
 * @property int $user_id ID пользователя
 * @property int $status Статус обработки обращения
 * @property string|null $date_create Дата создания
 *
 * @property User $user
 * @property MessageFile[] $messageFiles
 */
class Message extends \yii\db\ActiveRecord
{
    public $files = null;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['user_id'], 'required'],
            [['user_id', 'status'], 'default', 'value' => null],
            [['user_id', 'status'], 'integer'],
            [['date_create', 'files'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'message' => 'Сообщение',
            'user_id' => 'ID пользователя',
            'status' => 'Статус обработки обращения',
            'date_create' => 'Дата создания',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[MessageFiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessageFiles()
    {
        return $this->hasMany(MessageFile::className(), ['message_id' => 'id']);
    }
}
