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

        $searchModel = new MessageSearch(['user_id' => $user->id, 'reply_to_message_id' => null]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Message(['user_id' => $user->id, 'status' => 0]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->upload_files = UploadedFile::getInstances($model, 'upload_files');
            foreach ($model->upload_files as $upload_file) {
                $file = new File();
                $file->name = $upload_file->name;
                $file->mime = mime_content_type($upload_file->tempName);
                $file->size = filesize($upload_file->tempName);
                $file->status = File::STATUS_NONE;
                $file->user_id = $user->id;
                if ($file->save()) {
                    $filePath = $this->fileService->getFilePath($file);
                    $upload_file->saveAs($filePath);
                }
                $model->link('files', $file);
            }
            return $this->redirect(['index']);
        }

        return $this->render('index', [
                    'user' => $user,
                    'messages' => $this->renderPartial('/message/index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'user' => $user,
                        'createForm' => $this->renderPartial('/message/create', [
                            'model' => $model,
                        ]),
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

    public function actionPdf() {
        $pdf = new \app\components\GostPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 052');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 052', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        /*
          NOTES:
          - To create self-signed signature: openssl req -x509 -nodes -days 365000 -newkey rsa:1024 -keyout tcpdf.crt -out tcpdf.crt
          - To export crt to p12: openssl pkcs12 -export -in tcpdf.crt -out tcpdf.p12
          - To convert pfx certificate to pem: openssl pkcs12 -in tcpdf.pfx -out tcpdf.crt -nodes
         */

        // set additional information
        $info = [
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        ];

        // set document signature
        //exec("openssl smime -engine gost -sign -in test.pdf -out test.sig -nodetach -binary -signer client.crt -inkey client.key -outform SMIME");
        $certificate = '../test.sig';
        $pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);

        // set font
        $pdf->SetFont('helvetica', '', 12);

        // add a page
        $pdf->AddPage();

        // print a line of text
        $text = 'This is a <b color="#FF0000">digitally signed document</b> using the default (example) <b>tcpdf.crt</b> certificate.<br />To validate this signature you have to load the <b color="#006600">tcpdf.fdf</b> on the Arobat Reader to add the certificate to <i>List of Trusted Identities</i>.<br /><br />For more information check the source code of this example and the source code documentation for the <i>setSignature()</i> method.<br /><br /><a href="http://www.tcpdf.org">www.tcpdf.org</a>';
        $pdf->writeHTML($text, true, 0, true, 0);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // *** set signature appearance ***
        // create content for signature (image and/or text)
        $pdf->Image('images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');

        // define active area for signature appearance
        $pdf->setSignatureAppearance(180, 60, 15, 15);

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // *** set an empty signature appearance ***
        $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        // ---------------------------------------------------------
        //Close and output PDF document
        $content = $pdf->Output('example_052.pdf', 's');
        return Yii::$app->response->sendContentAsFile($content, 'test.pdf');
    }

}
