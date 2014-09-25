<?php

class DefaultController extends AdminController
{

	public function actionIndex() {
		$this->render('index');
	}

    public function actionLogin() {
        $this->layout = 'sign';
        $request = Yii::app()->request;
        $p = 'chi3850923';
        if ($request->isPostRequest) {
            $username = trim($request->getPost('username'));
            $password = trim($request->getPost('password'));
            $identity = new UserIdentity($username,$password);
            if($identity->authenticate()) {
                Yii::app()->user->login($identity);
                Yii::app()->request->redirect(Yii::app()->user->returnUrl);
            } else {

            }
        }

        $this->render('login');

    }

    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->request->redirect(Yii::app()->user->returnUrl);
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('login'),
                'users' => array('?')
            ),
            array(
                'deny',
                'actions' => array('index', 'logout'),
                'users' => array('?')
            )
        );
    }
}