<?php

class SuccessstoriesController extends Controller
{
    public $layout='//layouts/main';

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Successstories');
        $this->render('index',array('dataProvider'=>$dataProvider,));
    }

    public function loadModel($id)
    {
        $model=Successstories::model()->findByPk($id);
        if($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');

        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='successstories-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
