<?php

class ContactusController extends AdminController
{

    public function init()
    {
        $this->active = 'contactus';
        parent::init();
    }

    protected function initSave(Contactdata $model) {
        if (isset($_POST['Contactus'])) {
            $model->attributes = $_POST['Contactus'];
            if ($model->save()) {
                $this->redirect( Yii::app()->request->baseUrl.'/admin/contactus/index');
            }
        }
    }

    public function filters()
    {
        return array('accessControl',array('ext.yiibooster..filters.BootstrapFilter - delete'),);
    }

    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
        return array(
            array('allow','actions'=>array('index','view'),'users'=>array('*'),),
            array('allow','actions'=>array('delete'),'users'=>array('@'),),
            array('allow','actions'=>array('delete','create','update'),'users'=>array('admin'),),
            array('deny','users'=>array('*'),),
        );
    }

    /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $this->render('view',array('model'=>$this->loadModel($id),));
    }

//    public function actionUpdate($id)
//    {
//        $model=$this->loadModel($id);
//        $this->initSave($model);
//        $this->render('update',array('model'=>$model,));
//    }
//

    public function actionDelete($id)
    {
    if(Yii::app()->request->isPostRequest){
        $this->loadModel($id)->delete();

        if(!isset($_GET['ajax'])){
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }   else {
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionIndex()
    {
        $model = new Contactus('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contactus'])) {
            $model->attributes = $_GET['Contactus'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
//    $dataProvider=new CActiveDataProvider('Contactus');
//    $this->render('index',array('dataProvider'=>$dataProvider,));
    }


//    public function actionAdmin()
//    {
//    $model=new Contactus('search');
//    $model->unsetAttributes();  // clear any default values
//    if(isset($_GET['Contactus']))
//    $model->attributes=$_GET['Contactus'];
//
//    $this->render('admin',array(
//    'model'=>$model,
//    ));
//    }

    public function loadModel($id)
    {
        $model=Contactus::model()->findByPk($id);
        if($model===null)
        throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='contactus-form') {
        echo CActiveForm::validate($model);
        Yii::app()->end();
        }
    }
}
