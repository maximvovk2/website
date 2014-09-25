<?php

class TitlesController extends AdminController
{
    public function init() {
        $this->active = 'titles';
        parent::init();
    }

    public function actionIndex() {
        $model = new Titles('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(Titles $model)
    {
        if (isset($_POST['Titles'])) {
            // Save process
            $model->attributes = $_POST['Titles'];
            if ($model->save())
            {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('titles')
                    ->where('title = :title', array(':title' => $_POST['Titles']['title']))
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
        $model = new Titles();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/titles/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Titles::model()->findByPk($id);
                
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
        $model = Titles::model()->findByPk($id);
        $model->delete();
        $this->redirect('/admin/titles');
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