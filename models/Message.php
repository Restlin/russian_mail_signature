<?php

namespace app\models;

use Yii;
use yii\bootstrap\Html;

/**
 * This is the model class for table "message".
 *
 * @property int $id ИД
 * @property string|null $message Обращение
 * @property int $user_id ID пользователя
 * @property int $reply_to_message_id ID Обращение
 * @property int $status Статус обработки обращения
 * @property string|null $date_create Дата создания
 *
 * @property User $user
 * @property MessageFile[] $messageFiles
 * @property File[] $files
 * @property Message[] $replies
 * @property Message $reply
 * @property Message $question
 */
class Message extends \yii\db\ActiveRecord
{
    const STATUS_NONE = 0;
    const STATUS_WORK = 1;
    const STATUS_DONE = 2;
    const STATUS_IS_DONE = 3;
    const STATUS_ERROR = 4;

    public $upload_files = null;
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
            [['user_id', 'status', 'reply_to_message_id'], 'default', 'value' => null],
            [['user_id', 'status', 'reply_to_message_id'], 'integer'],
            [['date_create', 'files'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['reply_to_message_id'], 'exist', 'skipOnError' => true, 'targetClass' => Message::class, 'targetAttribute' => ['reply_to_message_id' => 'id']],
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
            'status' => 'Статус',
            'date_create' => 'Дата создания',
            'upload_files' => 'Файлы',
            'statusName' => 'Статус',
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

    public function getFiles()
    {
        return $this->hasMany(File::class, ['id' => 'file_id'])->via('messageFiles');
    }

    public function getReplies()
    {
        return $this->hasMany(Message::class, ['reply_to_message_id' => 'id']);
    }

    public function getReply()
    {
        return $this->hasOne(Message::class, ['reply_to_message_id' => 'id']);
    }

    public function getQuestion()
    {
        return $this->hasOne(Message::class, ['id' => 'reply_to_message_id']);
    }
    /**
     * @return string[]
     */
    public static function getStatuses(): array {
        return [
            static::STATUS_NONE => 'В очереди',
            static::STATUS_WORK => 'В работе',
            static::STATUS_DONE => 'Ответ отправлен',
            static::STATUS_IS_DONE => 'Ожидает согласования и отправки',
            static::STATUS_ERROR => 'Ошибка',
        ];
    }

    /**
     * @return string
     */
    public function getStatusName(): string {
        $statuses = static::getStatuses();
        $status = $statuses[$this->status] ?? 'Неверный статус';
        return Html::tag('span', $status, ['class' => 'badge']);
    }
}
