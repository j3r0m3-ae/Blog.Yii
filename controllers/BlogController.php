<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Messages;
use yii\helpers\Url;
use yii\web\UploadedFile;

class BlogController extends Controller
{

    public function actionIndex()
    {
        $messages = Messages::find()
            ->orderBy(['date' => SORT_DESC])
            ->all();
        $message = new Messages();

        return $this->render('index', [
            'messages' => $messages,
            'message' => $message,
        ]);
    }

    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $message = new Messages();

            $message->load(Yii::$app->request->post());
            $message->date = time();
            $message->file = UploadedFile::getInstance($message, 'file');
            $message->path_to_file = $message->getPathToFile();

            if ($message->save()){
                if ($message->path_to_file) {
                    $message->saveImage();
                }
                Yii::$app->session->setFlash('success', 'Сообщение успешно отправлено');
            }
        }
        Yii::$app->response->redirect(Url::to(['blog/index']));
    }
}