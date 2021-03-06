<?php

namespace app\models;

use app\services\FileService;
use Yii;
use yii\bootstrap\Html;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "file".
 *
 * @property int $id ID Файла
 * @property string $name Наименование файла
 * @property string $mime MIME тип
 * @property int $size Размер
 * @property int $status Статус обработки файла
 * @property int $user_id ID Пользователя
 * @property string $date_start Дата начала парсинга
 * @property string $date_end Дата завершения парсинга
 * @property string $sign Подпись
 */
class File extends ActiveRecord {

    const STATUS_NONE = 0;
    const STATUS_WORK = 1;
    const STATUS_DONE = 2;
    const STATUS_ERROR = 3;
    const STATUS_WRONG_TYPE = 4;
    const STATUS_WRONG_ENCODING = 5;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            //[['name', 'mime', 'user_id'], 'required'],
            [['size', 'status', 'id'], 'integer'],
            [['name', 'mime'], 'string', 'max' => 255],
            [['date_start', 'date_end', 'sign'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ИД Файла',
            'name' => 'Наименование файла',
            'mime' => 'MIME тип',
            'size' => 'Размер',
            'status' => 'Статус обработки файла',
            'user_id' => 'ИД пользователя',
            'date_start' => 'Дата начала парсинга',
            'date_end' => 'Дата завершения парсинга',
            'sign' => 'Подпись',
            'signCheck' => 'Результат проверки подписи',
        ];
    }

    public function afterDelete() {
        parent::afterDelete();
        // @todo вынести в EventDispatcher
        $container = Yii::$container;
        try {
            $service = $container->get(FileService::class);
            $service->deleteFile($this);
        } catch (\Exception $exception) {
            Yii::error($exception->getMessage());
        }
    }

    /**
     * @return string[]
     */
    public static function getStatuses(): array {
        return [
            static::STATUS_NONE => 'В очереди',
            static::STATUS_WORK => 'В работе',
            static::STATUS_DONE => 'Обработка завершена',
            static::STATUS_ERROR => 'Ошибка обработки',
            static::STATUS_WRONG_TYPE => 'Неверный формат',
            static::STATUS_WRONG_ENCODING => 'Неверная кодировка',
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

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileMessage() {
        return $this->hasOne(MessageFile::class, ['file_id' => 'id']);
    }

    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
