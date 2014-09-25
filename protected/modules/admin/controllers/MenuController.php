<?php

class MenuController extends AdminController
{
    public function init() {
        $this->active = 'menu';

        parent::init();
    }

    public function actionIndex() {
//        $model = Yii::app()->db->createCommand()
//            ->select('navigation.id, navigation.title, navigation_categories.title as category_title')
//            ->from('navigation')
//            ->join('navigation_categories', 'navigation_categories.id = navigation.category')
//            ->queryAll();
        $model = new Navigation('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(Navigation $model)
    {
        if (isset($_POST['Navigation'])) {
            // Save process
            $model->attributes = $_POST['Navigation'];
            if ($model->save())
            {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('navigation')
                    ->where('title = :title', array(':title' => $_POST['Navigation']['title']))
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
        $model = new Navigation();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/menu/update/id/'.$id);    
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Navigation::model()->findByPk($id);
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
        $this->render('update', $render );
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $model = Navigation::model()->findByPk($id);
        $model->delete();
        $this->redirect('/admin/menu');
        exit();
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('navigation', array('position' => $id), 'id = ' . $item);
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