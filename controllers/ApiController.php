<?php

namespace app\controllers;

use app\models\User;
use app\services\FileService;
use app\services\UserESignService;
use Yii;
use yii\web\Controller;

/**
 * Api контроллер обеспечивает обработку запросов по работе с подписями
 */
class ApiController extends Controller {

    private FileService $fileService;
    private UserESignService $userESignService;

    public function __construct($id, $module,
            FileService $fileService,
            UserESignService $userESignService,
            $config = []) {
        $this->fileService = $fileService;
        $this->userESignService = $userESignService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Создание сертификата пользователя
     * @param int $userId ИД пользователя
     * @return string
     */
    public function actionCreate(int $userId) {
        $user = User::findOne($userId);

        $this->userESignService->create($user);
        return $this->userESignService->get($user);        
    }

    /**
     * Создать подпись файла
     * @param string $filePath путь до файла
     * @param int $userId ИД пользователя
     * @return string
     */
    public function actionSign(string $filePath, int $userId) {
        $user = User::findOne($userId);
        $name = basename($filePath);

        $sigFile = $this->fileService->signRaw($filePath, $user);
        return Yii::$app->response->sendContentAsFile($sigFile, $name . '.sig');
    }

    /**
     * Проверить подпись файла
     * @param string $filePath путь до файла
     * @param string $sigPath путь до подписи
     * @param int $userId ИД пользователя
     * @return string
     */
    public function actionVerify(string $filePath, string $sigPath, int $userId) {
        $user = User::findOne($userId);

        return $this->fileService->verifyRaw($filePath, $sigPath, $user);
    }

}
