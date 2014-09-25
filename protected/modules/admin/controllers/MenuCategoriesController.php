<?php

class MenuCategoriesController extends AdminController
{
    public function init() {
        $this->active = 'menu';
        parent::init();
    }

    public function actionIndex() {
        $model = new NavigationCategories('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(NavigationCategories $model)
    {
        if (isset($_POST['NavigationCategories'])) {
            // Save process
            $model->attributes = $_POST['NavigationCategories'];
            if ($model->save())
            {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('navigation_categories')
                    ->where('title = :title', array(':title' => $_POST['NavigationCategories']['title']))
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
        $model = new NavigationCategories();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/menuCategories/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = NavigationCategories::model()->findByPk($id);
        
        //$this->initSave($model);
        
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
        $model = NavigationCategories::model()->findByPk($id);
        $model->delete();
        $this->redirect('/admin/menuCategories');
        exit();
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