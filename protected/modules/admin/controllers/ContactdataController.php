<?php

class ContactdataController extends AdminController
{
    public function init() {
        $this->active = 'contactdata';
        parent::init();
    }

    protected function initSave(Contactdata $model)
    {
        if (isset($_POST['Contactdata'])) {
            $model->attributes = $_POST['Contactdata'];
            if ($model->save()) {
                return true;
//                $this->redirect( Yii::app()->request->baseUrl.'/admin/contactdata/index');
            } else {
                return false;
            }
        }
    }

    public function filters()
    {
        return array('accessControl',array('ext.yiibooster..filters.BootstrapFilter - delete'));
    }

    public function accessRules()
    {
        return array(
            array('allow','actions'=>array('index'),'users'=>array('*'),),
            array('allow', 'actions'=>array('create','update','delete'),'users'=>array('@'),),
            array('deny', 'users'=>array('*'),),
);
    }

    public function actionCreate()
    {
        $model=new Contactdata;

//    //    $this->performAjaxValidation($model);
//
//        if(isset($_POST['Contactdata'])) {
//            $model->attributes=$_POST['Contactdata'];
//            if($model->save()) {
//            $this->redirect(array('index','id'=>$model->id));
//            }
//        }
        $this->initSave($model);

        $this->render('create',array('model'=>$model,));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

//    // $this->performAjaxValidation($model);
//
//        if(isset($_POST['Contactdata'])) {
//            $model->attributes=$_POST['Contactdata'];
//            if($model->save()){
//                $this->redirect(array('view','id'=>$model->id));
//            }
//        }
                
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
        $this->render('update',$render);
    }

    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if(!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        } else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function actionIndex()
    {
        $model = new Contactdata('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contactdata'])) {
            $model->attributes = $_GET['Contactdata'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
//        $dataProvider=$model->search();
//        $this->render('index',array('dataProvider'=>$dataProvider,));
    }

    public function loadModel($id)
    {
        $model=Contactdata::model()->findByPk($id);

        if($model===null) {
            throw new CHttpException(404,'The requested page does not exist.');
        }
        return $model;
    }

//    protected function performAjaxValidation($model)
//    {
//        if(isset($_POST['ajax']) && $_POST['ajax']==='contactdata-form') {
//            echo CActiveForm::validate($model);
//            Yii::app()->end();
//        }
//    }
}
