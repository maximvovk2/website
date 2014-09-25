<?php

class PartnersController extends AdminController
{
    public function init() {
        $this->active = 'partners';
        parent::init();
    }

    public function actionIndex() {
        $model = Partners::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    function initSave(Partners $model)
    {
        if (isset($_POST['Partners'])) {
            // Save process
            $oldImg = $model->img;
            $model->attributes = $_POST['Partners'];
            $uploadFile = CUploadedFile::getInstance($model, 'img');
            if($uploadFile !== null) {
                $model->img = $uploadFile;
            }
            if ($model->save()) {
                if (!empty($uploadFile)){
                    if(!is_dir('images/partners/'. $model->id)){
                        mkdir('images/partners/'. $model->id);
                    }
                    $model->img->saveAs('images/partners/'. $model->id . '/' . $model->img->getName());
                    if(is_file('images/partners/'. $model->id . '/' . $oldImg)) {
                        unlink('images/partners/'. $model->id . '/' . $oldImg);
                    }
                }
//                $this->redirect('/admin/partners');
            }
        }
    }

    public function actionAdd()
    {
        $model = new Partners();
        $this->initSave($model);
        $this->render('add', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = Partners::model()->findByPk($id);
        $this->initSave($model);
        $this->render('edit', array('model' => $model));
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $model = Partners::model()->findByPk($id);
        if($model->delete()){
            $this->removeDirectory('images/partners/'. $model->id);
        }

        $this->redirect('/admin/partners');
        exit();
    }

    function removeDirectory($dir) {
        if ($objs = glob($dir."/*")) {
            foreach($objs as $obj) {
                is_dir($obj) ? removeDirectory($obj) : unlink($obj);
            }
        }
        rmdir($dir);
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