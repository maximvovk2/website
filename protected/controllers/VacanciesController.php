<?php

class VacanciesController extends Controller
{
	public function actionIndex()
	{
        $model = Vacancies::model()->findAll(array('order' => 'position'));
		$this->render('index', array('model' => $model));
	}

    public function actionSend($id)
    {
        $this->render('send', array('id' => $id));
    }

    public function actionGetJob()
    {
        $request = Yii::app()->request;
        if ($request->isAjaxRequest) {
            $id = $request->getPost($id);
            $job = Vacancies::model()->findByPk($id);
            if ($job->title !== null) {
                echo CJavaScript::encode(array('job' => $job));
                Yii::app()->end();
            } else {
                echo CJavaScript::encode(array('error' => 'wrong_params'));
                Yii::app()->end();
            }
        }
    }

    public function actionSendCv()
    {
        $request = Yii::app()->request;
        if (!$request->isPostRequest) {
            throw new CHttpException(404, 'Bad request');
        }

        $jobId = $request->getPost('jobid');
        $name = trim($request->getPost('name'));
        $email = trim($request->getPost('email'));
        $message = trim($request->getPost('message'));
        $job = Vacancies::model()->findByPk($jobId);
        $cv = (empty($_FILES['cv'])) ? array() : $_FILES['cv'];
        $errors = array();
        if ($name == '') {
            $errors['name'] = 'empty_name';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'empty_email';
        }

        if (empty($cv['name'])) {
            $errors['cv'] = 'empty_cv';
        }

        if (count($errors) > 0) {
            echo CJavaScript::jsonEncode(array('errors' => $errors));
        } else {

            $attach = 'cv' . DIRECTORY_SEPARATOR . $cv['name'];
            move_uploaded_file($cv['tmp_name'], $attach);

            $mailer = new YiiMailer();
            $mailer->setFrom('konstantin.kostin@chisw.us', $name . ' <' . $email . '>');
            $mailer->setSubject('СV for' . ' (' . $job->title . ')');
            $mailer->setAttachment($attach);
            $mailer->setView('cv');
            $mailer->setData(array('msg' => Text::formatText($message)));
            $mailer->render();
            $mailer->IsSMTP(true);
            $mailer->setTo('flaksa@list.ru');
            $mailer->SMTPAuth = true;
            $mailer->Host = 'mail.ukraine.com.ua';
            $mailer->Username = 'chisw_info@chisw.us';
            $mailer->Password = 'eL533Nbd';
            if (!$mailer->send()) {
                $errors['email'] = 'not_sent';
            }

            if (is_file($attach)) {
                unlink($attach);
            }

            if (count($errors) > 0) {
                echo CJavaScript::jsonEncode(array('errors' => $errors));
            } else {
                echo CJavaScript::jsonEncode(array('result' => 'OK'));
            }
        }
    }

}