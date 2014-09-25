<?php

class SuccessstoriesController extends AdminController
{
    public function init()
    {
        $this->active = 'successstories';
        parent::init();
    }

    public function actions() {
        return array(
            'fmanager'=>array(
                'class'=>'ext.fm.ElFinderAction',
            ),
        );
    }

    public function actionchangefollowing(){//OrdersFollowing() {
        $model = Successstories::model()->findAll(array('order' => 'position'));
        $this->render('orderposition', array('model' => $model));
    }
    
        public function actionsaveorders() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('successstories', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }
    
    public function filters()
    {
        return array('accessControl', array('ext.yiibooster..filters.BootstrapFilter - delete'),);
    }

//    public function accessRules()
//    {
//        return array(
//            array('allow','actions'=>array('index','view'),'users'=>array('*'),),
//            array('allow','actions'=>array('create','update','delete'),'users'=>array('@')),
//            array('allow','actions'=>array('create','update','delete','deletefile'),'users'=>array('admin'),),
//            array('deny','users'=>array('*')),
//        );
//    }

    public function actionView($id)
    {
        $this->render('view',array('model'=>$this->loadModel($id),));
    }

//    protected function initSave(Successstories $model) {
//        if (isset($_POST['Successstories'])) {
//            $model->attributes = $_POST['Successstories'];
//
//            if ($model->save()) {
////                $model->image->saveAs("Yii::app()->request->baseUrl;.'path/to/localFile");
//                $this->redirect( Yii::app()->request->baseUrl.'/admin/successstories/index');
//            }
//        }
//    }

//    public function actionCreate()
//    {
//        $model=new Successstories;
////        $model->pic=CUploadedFile::getInstance($model,'pic');
//
//
//        $this->initSave($model);
//
//        $this->render('create',array('model'=>$model,));
//    }
//
//    public function actionUpdate($id)
//    {
//        $model=$this->loadModel($id);
////        $model->pic=CUploadedFile::getInstance($model,'pic');
//
//
//        $this->initSave($model);
//
//        $this->render('update',array('model'=>$model,));
//    }

    public function actionUpdate($id=null,$flag=FALSE){
        if ($id === null) {
            $model = new Successstories();
        } else if(!$model=$this->loadModel($id)) {
            throw new CHttpException(404);
        }
        if (isset($_POST['Successstories'])) {
            $model->attributes = $_POST['Successstories'];
            if ($model->save()) {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('successstories')
                    ->where('result = :result', array(':result' => $_POST['Successstories']['result']))
                    ->queryAll();
                $id = $id[0]['id'];
                $this->render('update',array('model'=>$model,'flag'=>true));
//                $this->redirect('/admin/successstories/update/id/'.$id);
            } else {
                $this->render('update',array('model'=>$model,'flag'=>false));
            }
        } else {
            $this->render('update',array('model'=>$model,'flag'=>false));
        }
    }


    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id)->delete();

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else{
            throw new CHttpException(400,'Неправильный запрос');
        }
    }
    public function actionDeletefile($id)
    {
        $model = Successstories::model()->findByPk($id);
        if(is_file($model->pic))
        {
            unlink($model->pic);
            $model->pic = '';
            $model->save();
        }
        $this->redirect('/admin/successstories/update/id/'.$model->id);
    }


    public function actionIndex()
    {
        $model = new Successstories('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Successstories'])) {
            $model->attributes = $_GET['Successstories'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
//    $dataProvider=new CActiveDataProvider('Successstories');
//    $this->render('index',array(
//    'dataProvider'=>$dataProvider,
//    ));
    }

    public function loadModel($id)
    {
        $model=Successstories::model()->findByPk($id);
        if($model===null){
            throw new CHttpException(404,'Запрощенной страницы не существует');
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax']==='successstories-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionBrowse()
    {
        $this->layout='//layouts/empty_backend';
        $this->render('browser');
    }
}
