<?php

namespace app\controllers;

use app\models\File;
use app\models\Message;
use app\models\MessageSearch;
use app\models\User;
use app\security\ForgotForm;
use app\security\LoginForm;
use app\security\RegistrationForm;
use app\security\ResetPwdForm;
use app\services\FileService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class SiteController extends Controller {

    private ?User $user = null;
    private FileService $fileService;

    public function __construct($id, $module,
            FileService $fileService,
            $config = []) {
        $this->fileService = $fileService;
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                //'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $user = Yii::$app->user->identity->getUser();
        if ($user->isAdmin) {
            $searchModel = new MessageSearch(['reply_to_message_id' => null/* , 'replyEmpty' => true */]);
        } else {
            $searchModel = new MessageSearch(['user_id' => $user->id, 'reply_to_message_id' => null]);
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Message(['user_id' => $user->id, 'status' => 0]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload_files = UploadedFile::getInstances($model, 'upload_files');
            foreach ($model->upload_files as $uploadedFile) {
                $file = $this->fileService->createFile($uploadedFile, $user);
                if ($file->id) {
                    $model->link('files', $file);
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('index', [
                    'user' => $user,
                    'messages' => $this->renderPartial('/message/index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'createForm' => $this->renderPartial('/message/create', [
                            'model' => $model,
                        ]),
                        'user' => $user,
                    ]),
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Регистрация пользователя
     */
    public function actionRegistration() {
        $model = Yii::$container->get(RegistrationForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(['/user/confirm', 'id' => $model->getUser()->id]);
        }

        return $this->render('registration', [
                    'model' => $model,
        ]);
    }

    /**
     * Забыл пароль
     */
    public function actionForgot() {
        $model = Yii::$container->get(ForgotForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->restore()) {
            return $this->render('forgot-send');
        }
        return $this->render('forgot', [
                    'model' => $model,
        ]);
    }

    /**
     * Сброс паролья
     */
    public function actionResetPwd(string $token) {
        $user = $this->userRepository->findOneByResetToken($token);
        if ($user === null || ($user && $user->pwd_reset_token_unixtime > time() + Yii::$app->params['tokenLive'])) {
            throw new NotFoundHttpException('Указанный вами токен не действителен!');
        }
        $model = new ResetPwdForm();
        $model->user = $user;
        if ($model->load(Yii::$app->request->post()) && $model->setNewPwd()) {
            return $this->redirect(['/site/login']);
        }
        return $this->render('reset-pwd', [
                    'model' => $model,
        ]);
    }    

}
