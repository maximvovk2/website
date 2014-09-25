<?php

class TechController extends AdminController
{
    public function init() {
        $this->active = 'tech';

        Yii::app()->clientScript->registerScriptFile(
            CHtml::asset(
                Yii::getPathOfAlias('admin.assets.js'). '/tech.js'
            ));
        parent::init();
    }
    public function actionIndex() {
        $techList = new Tech('search');
        $this->render('index', array('techList' => $techList));
    }

    public function actionchangefollowing(){//OrdersFollowing() {
        $model = Tech::model()->findAll(array('order' => 'position'));
        $this->render('orderposition', array('model' => $model));
    }
    
        public function actionsaveorders() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('tech', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }
    
    public function actionAdd()
    {
        $model = new Tech();
        if (isset($_POST['Tech'])) {
            $model->attributes = $_POST['Tech'];
            if ($model->save()) {
                if(!empty($_POST['list'])){
                    foreach($_POST['list'] as $item){
                        $techList = new TechList;
                        $techList->tech_id = $model->id;
                        $techList->title = $item;
                        $techList->save(false);
                    }
                }
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('tech')
                    ->where('title = :title', array(':title' => $_POST['Tech']['title']))
                    ->queryAll();
                $id = $id[0]['id'];
                
                $this->redirect('/admin/tech/update/id/'.$id);           
            }
        }
        if(isset($_POST['list'])){
            $list = $_POST['list'];
        }else{
            $list = null;
        }
        $this->render('add', array('model' => $model, 'list' => $list));
    }

    public function actionUpdate($id)
    {
        $list = TechList::model()->findAll('tech_id = :id', array(':id' => $id));
        $model = Tech::model()->findByPk($id);
        $render = array();
        $render['model'] = $model;
        $render['list'] = $list;
        if (isset($_POST['Tech'])) {
            $model->attributes = $_POST['Tech'];
            if ($model->save()) {
                foreach($list as $item){
                    TechList::model()->deleteByPk($item->id);
                }
                if(!empty($_POST['list'])){
                    foreach($_POST['list'] as $item){
                        $techList = new TechList;
                        $techList->tech_id = $model->id;
                        $techList->title = $item;
                        $techList->save(false);
                    }
                }
            $render['flag'] = TRUE;
            }
        }
        
        $this->render('update', $render);
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $tech = Tech::model()->findByPk($id);
        $tech->delete();
        $this->redirect('/admin/tech/index');
        exit();
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if ($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('tech', array('position' => $id), 'id = ' . $item);
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