<?php

namespace app\controllers;

use app\models\User;
use app\models\UserSearch;
use app\services\UserESignService;
use app\security\ChangePwdForm;
use app\security\EmailConfirmForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

    private ?User $user = null;
    private UserESignService $userESignService;

    public function __construct(
            $id,
            $module,
            UserESignService $userESignService,
            $config = []
    ) {
        $this->userESignService = $userESignService;
        $this->user = Yii::$app->user->getIsGuest() ? null : Yii::$app->user->identity->getUser();
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'create-e-sign' => ['POST'],
                    'revoke-e-sign' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['view', 'change-pwd', 'change-pwd-validate', 'update', 'create-e-sign', 'revoke-e-sign'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => fn() => $this->user && $this->user->isAdmin,
                    ],
                    [
                        'actions' => ['confirm', 'registration-success'],
                        'allow' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$model->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        return $this->render('view', [
                    'model' => $model,
                    'eSign' => $this->userESignService->get($model),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$model->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Подтверждение email
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirm(int $id) {
        $user = $this->findModel($id);
        $model = new EmailConfirmForm();
        $model->user = $user;
        if ($model->load(Yii::$app->request->post()) && $model->confirm()) {
            return $this->redirect(['registration-success']);
        }

        return $this->render('confirm', [
                    'model' => $model,
        ]);
    }

    public function actionRegistrationSuccess() {
        return $this->render('registration_success');
    }

    public function actionChangePwd() {
        if (Yii::$app->request->isAjax) {
            $model = new ChangePwdForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->setNewPwd()) {
                    return $this->redirect(['/user/view', 'id' => $this->user->id]);
                }
            }
        }
    }

    public function actionChangePwdValidate() {
        if (Yii::$app->request->isAjax) {
            $model = new ChangePwdForm();
            if ($model->load(Yii::$app->request->post())) {
                $model->validate();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }
    }

    public function actionCreateESign(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$model->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        $fields = [
            'r' => 'api/create',
            'userId' => $model->id,
        ];
        $query = http_build_query($fields);
        $ch = curl_init();
        $host = Yii::$app->params['apiHost'] ?? '';
        curl_setopt($ch, CURLOPT_URL, $host . '/index.php?' . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $results = curl_exec($ch);
        //$this->userESignService->create($model);
        return $this->redirect(['/user/view', 'id' => $this->user->id]);
    }

    public function actionRevokeESign(int $id) {
        $model = $this->findModel($id);
        if ($model->id != $this->user->id && !$model->isAdmin) {
            throw new ForbiddenHttpException('У Вас нет доступа к данному профилю!');
        }
        $this->userESignService->revoke($model);
        return $this->redirect(['/user/view', 'id' => $this->user->id]);
    }

}
