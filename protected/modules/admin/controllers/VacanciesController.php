<?php

class VacanciesController extends AdminController
{
    public function init() {
        $this->active = 'vacancies';
        parent::init();
    }

    public function actionIndex() {
//        $model = Vacancies::model()->findAll(array('order' => 'position'));
        $model = new Vacancies('search');
        $this->render('index', array('model' => $model));
    }

    public function actionchangefollowing(){//OrdersFollowing() {
        $model = Vacancies::model()->findAll(array('order' => 'position'));
        $this->render('orderposition', array('model' => $model));
    }
    
        
    public function actionsaveorders() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('vacancies', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }
    
    function initSave(Vacancies $model)
    {
        if (isset($_POST['Vacancies'])) {
            // Save process
            $model->attributes = $_POST['Vacancies'];
            if ($model->save()) {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('vacancies')
                    ->where('title = :title', array(':title' => $_POST['Vacancies']['title']))
                    ->queryAll();
                $id = $id[0]['id'];
                return $id;
            } else {
                return false;
            }
        }
    }

    public function actionAdd() {
        $model = new Vacancies();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/vacancies/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = Vacancies::model()->findByPk($id);
                
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
        $this->render('update', $render);
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $job = Vacancies::model()->findByPk($id);
        $job->delete();
        header('Location:' . Yii::app()->getBaseUrl(true) . '/admin/vacancies');
        exit();
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if ($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('vacancies', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }

    public function actions() {
        return array(
            'fmanager'=>array(
                'class'=>'ext.fm.ElFinderAction',
            ),
        );
    }

    public function actionBrowse()
    {
        $this->layout='//layouts/empty_backend';
        $this->render('browser');
    }

}
