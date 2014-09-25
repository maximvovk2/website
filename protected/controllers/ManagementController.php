<?php

class ManagementController extends Controller
{
	public function actionIndex()
	{
        $model = Management::model()->findAll();
        $this->render('index', array('model' => $model));
	}
}