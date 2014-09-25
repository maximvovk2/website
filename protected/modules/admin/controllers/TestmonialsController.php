<?php

class TestmonialsController extends AdminController
{
    public function init() {
        $this->active = 'testmonials';
        parent::init();
    }

    public function actionIndex() {
//        $model = Conditions::model()->findAll(array('order' => 'position'));
        $model = new Testmonials('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(Testmonials $model)
    {
        if (isset($_POST['Testmonials']))
        {
            // Save process
            $model->attributes = $_POST['Testmonials'];

            if ($model->save())
            {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('testmonials')
                    ->where('title = :title', array(':title' => $_POST['Testmonials']['title']))
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
        $model = new Testmonials();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/testmonials/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Testmonials::model()->findByPk($id);
        
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
        $model = Testmonials::model()->findByPk($id);
        $model->delete();
        header('Location: /admin/testmonials');
        exit();
    }


}