<?php

class ClientsController extends AdminController
{
    public function init() {
        $this->active = 'Clients';
        parent::init();
    }

    public function actionIndex() {
        $model = new Clients('search');
        $this->render('index', array('model' => $model));
    }
    
    public function actionchangefollowing(){
        $model = Clients::model()->findAll(array('order' => 'position'));
        $this->render('orderposition', array('model' => $model));
    }
    
        public function actionsaveorders() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('clients', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }
    

    function initSave(Clients $model)
    {
        if (isset($_POST['Clients'])) {
            // Save process
            $model->attributes = $_POST['Clients'];
            if ($model->save())
            {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('clients')
                    ->where('title = :title', array(':title' => $_POST['Clients']['title']))
                    ->queryAll();
                $id = $id[0]['id'];
                return $id;
            } else {
                return false;
            }
        }
    }

    public function actionAdd()
    {
        $model = new Clients();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/Clients/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Clients::model()->findByPk($id);
                
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
        //$this->initSave($model);
        
        $this->render('update', $render);
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $model = Clients::model()->findByPk($id);
        $model->delete();
        $this->redirect('/admin/Clients');
        exit();
    }

    public function actionDeletefile($id)
    {
        $model = Clients::model()->findByPk($id);
        if(is_file($model->logo))
        {
            unlink($model->logo);
            $model->logo = '';
            $model->save();
        }
        $this->redirect('/admin/Clients/update/id/'.$model->id);
    }

//    public function actions() {
//        return array(
//            'fmanager'=>array(
//                'class'=>'ext.fm.ElFinderAction',
//            ),
//        );
//    }

//    public function actionBrowse()
//    {
//        $this->layout='//layouts/empty_backend';
//        $this->render('browser');
//    }

}