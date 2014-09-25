<?php

class UsersController extends AdminController
{
    public function init() {
        $this->active = 'users';

        parent::init();
    }

    public function actionIndex() {
        $model = new Users('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(Users $model)
    {
        if (isset($_POST['Users'])) {
            // Save process
            $oldPassword = $model->password;
            $model->attributes = $_POST['Users'];
            if($_POST['Users']['password'] == null) {
                $model->password = $oldPassword;
            }else{
                $model->password = md5($_POST['Users']['password']);
            }
            if ($model->save()) {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('users')
                    ->where('username = :username', array(':username' => $_POST['Users']['username']))
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
        $model = new Users();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/users/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Users::model()->findByPk($id);
                
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
        $model = Users::model()->findByPk($id);
        $model->delete();
        $this->redirect('/admin/users');
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