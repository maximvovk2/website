<?php

class ContactusController extends Controller
{
	public $layout='//layouts/column2';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
        $model = new Contactus;
        $model2 = Contactdata::model()->find();

        if (isset($_GET['Contactdata'])) {
            $model2->attributes = $_GET['Contactdata'];
        }
        if (isset($_POST['Contactus'])) {
            $model->attributes = $_POST['Contactus'];
            if($model->save()) {
                Yii::app()->user->setFlash('success',"Вопрос отправлен");

                $this->redirect(array('staticpages/contactus','id'=>$model->id));
            }
        }
        Yii::app()->clientScript->registerScript(
            'myHideEffect',
            '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
            CClientScript::POS_READY
        );
        $dataProvider=new CActiveDataProvider('Contactus');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
            'model'=>$model,
            'model2'=>$model2,
		));

	}

	public function loadModel($id)
	{
		$model=Contactus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

}
//	public function actionCreate()
//	{
//		$model=new Contactus;
//
//		if(isset($_POST['Contactus']))
//		{
//			$model->attributes=$_POST['Contactus'];
//			if($model->save())
//				$this->redirect(array('index','id'=>$model->id));
//		}
//
//		$this->render('index',array(
//			'model'=>$model,
//		));
//	}