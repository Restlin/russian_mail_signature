<?php

namespace app\controllers;

use app\models\File;
use app\models\FileSearch;
use app\models\User;
use app\services\FileService;
use Yii;
use app\models\Message;
use app\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller {

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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSend($id) {
        $model = $this->findModel($id);
        $model->status = Message::STATUS_DONE;
        if ($model->save()) {
            foreach ($model->files as $file) {
                $this->fileService->sign($file);
            }
            $base = $this->findModel($model->reply_to_message_id);
            $base->status = Message::STATUS_DONE;            
            $base->save();
        }
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $user = Yii::$app->user->identity->getUser();

        $searchModel = new FileSearch(['messageId' => $id]);
        $dataProvider = $searchModel->search([]);

        $model = $this->findModel($id);
        $replyModel = new Message(['user_id' => $user->id, 'status' => Message::STATUS_WORK, 'reply_to_message_id' => $model->id]);
        if ($replyModel->load(Yii::$app->request->post()) && $replyModel->save()) {
            $replyModel->upload_files = UploadedFile::getInstances($model, 'upload_files');
            foreach ($replyModel->upload_files as $upload_file) {
                $file = new File();
                $file->name = $upload_file->name;
                $file->mime = mime_content_type($upload_file->tempName);
                $file->size = filesize($upload_file->tempName);
                $file->status = File::STATUS_NONE;
                $file->user_id = $user->id;
                if ($file->save()) {
                    $filePath = $this->fileService->getFilePath($file);
                    $upload_file->saveAs($filePath);
                    $replyModel->link('files', $file);
                }
            }
            $replyModel->status = Message::STATUS_IS_DONE;
            $replyModel->save();
            $model->status = Message::STATUS_WORK;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('view', [
                    'user' => $user,
                    'model' => $model,
                    'files' => $this->renderPartial('/file/index-files', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'fileService' => $this->fileService,
                    ]),
                    'createReply' => $this->renderPartial('create', [
                        'model' => $replyModel,
                    ]),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['/site/index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionPdf($id) {
        $model = $this->findModel($id);
        
        $pdf = new \app\components\GostPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($model->user->name.' '.$model->user->surname);
        $pdf->SetTitle("Обращение №{$model->id}");
        $pdf->SetSubject("Обращение №{$model->id} подписано электронной подписью");
        $pdf->SetKeywords('TCPDF, PDF, ГОСТ, Почта Росссии, Хакатон, IT-animals');        

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
        
        $certificate = 'user';
        $pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, []);
        
        $pdf->SetFont('dejavusans', '', 12, '', true);

        // add a page
        $pdf->AddPage();

        $pdf->writeHTML($model->message, true, 0, true, 0);
        
        if($model->files) {
            $pdf->writeHTML('<div style="border-top: 1px solid #888; margin:10px;">Прикрепленные файлы:</div>', true, 0, true, 0);
            foreach($model->files as $file) {
                $filePath = $this->fileService->getFilePath($file);
                if(file_exists($filePath.'.pdf')) {
                    $filePath .= '.pdf';
                }
                $pdf->Annotation($pdf->getX()-5, $pdf->GetY(), 5, 5, $file->name, ['Subtype'=>'FileAttachment', 'Name' => $file->name, 'FS' => $filePath]);
                $pdf->writeHTML("<div>{$file->name}</div>", true, 0, true, 0);
            }
        }        

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // *** set signature appearance ***        
        $signY = $pdf->getY();
        $pdf->Image('images/sign.png', 180, $signY, 15, 15, 'PNG'); // create content for signature (image and/or text)
        $pdf->setSignatureAppearance(180, $signY, 15, 15); // define active area for signature appearance

        // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        // *** set an empty signature appearance ***
        //$pdf->addEmptySignatureAppearance(180, 80, 15, 15);

        // ---------------------------------------------------------
        //Close and output PDF document
        $content = $pdf->Output("обращение_{$model->id}.pdf", 's');
        return Yii::$app->response->sendContentAsFile($content, "обращение_{$model->id}.pdf");
    }

}
