<?php

namespace app\services;

use Yii;
use app\models\File;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\helpers\FileHelper;
use yii\base\Exception;

final class FileService extends BaseObject {

    /**
     * Пути файлов для удаления
     * @var array|File[]
     */
    private static array $filesForDel = [];

    /**
     * Путь до папки с файлами
     * @var string
     */
    private string $path = '';

    /**
     * Формат подписи
     * @var string
     */
    private string $form = 'SMIME';

    /**
     * Путь до пользовательского ключа
     */
    private string $pathCA = '@app/keys/CA';

    /**
     * Путь до пользовательского ключа
     */
    private string $clientKeysPath = '@app/keys';

    /**
     * FileService constructor.
     * @param array $params
     */
    public function __construct(array $params = []) {
        if (!key_exists('path', $params)) {
            throw new InvalidArgumentException();
        }
        $this->path = $params['path'];
    }

    /**
     * Проверка существования директории и создание
     * @param File $file
     * @throws Exception
     */
    public function createDir(File $file): void {
        $path = $this->getFileDir($file);
        if (!file_exists($path)) {
            FileHelper::createDirectory($path);
        }
    }

    /**
     * Путь до файла
     * @param File $file
     * @return string
     */
    public function getFilePath(File $file): string {
        return $this->getFileDir($file) . $file->id;
    }

    /**
     * Директория файла
     * @param File $file
     * @return string
     */
    public function getFileDir(File $file): string {
        $dir = intdiv($file->id, 1000) * 1000;
        return Yii::getAlias($this->path . '/' . $dir . '/' . $file->id . '/');
    }

    /**
     * Добавление пути к файлу на удаление
     * @param File[] $files
     */
    public function addFileForDelete(array $files): void {
        static::$filesForDel = array_merge(static::$filesForDel, $files);
    }

    /**
     * Удаленеи файлов self::$pathsForDel
     */
    public function deletePreparedFiles(): void {
        foreach (static::$filesForDel as $file) {
            $file->delete();
        }
    }

    /**
     * @param File $file
     */
    public function deleteFile(File $file): void {
        $fp = $this->getFilePath($file);
        if (file_exists($fp)) {
            unlink($fp);
        }
    }

    public function sign(File $file): bool {
        $fp = $this->getFilePath($file);
        $clientKeysPath = Yii::getAlias($this->clientKeysPath);
        exec("openssl smime -engine gost -sign -in $fp -out $fp.sig -nodetach -binary -signer $clientKeysPath/client.crt -inkey $clientKeysPath/client.key -outform {$this->form}");
        $file->sign = file_get_contents($fp . '.sig');
        return $file->save();
    }

    public function checkSign(File $file): string {
        $output = 'Файл не подписан';
        if ($file->sign) {
            $fp = $this->getFilePath($file);
            $clientKeysPath = Yii::getAlias($this->clientKeysPath);
            $pathCA = Yii::getAlias($this->pathCA);
            $output = exec("openssl cms -engine gost -verify -in $fp.sig -inform {$this->form} -CAfile $pathCA/ca.crt -out $fp -certsout $clientKeysPath/client.crt 2>&1");
            if ($output == 'Verification successful') {
                $output = 'Подпись верна';
            } else {
                $output = 'Подпись не прошла проверку';
            }
        }
        return $output;
    }

}
