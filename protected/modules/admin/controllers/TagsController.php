<?php

class TagsController extends AdminController
{
    public function init() {
        $this->active = 'tags';
        parent::init();
    }

    public function actionIndex() {
        $model = new Tags('search');
        $this->render('index', array(
            'model' => $model
        ));
    }

    function initSave(Tags $model)
    {
        if (isset($_POST['Tags'])) {
            // Save process
            $model->attributes = $_POST['Tags'];
            if ($model->save()) {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('tags')
                    ->where('title = :title', array(':title' => $_POST['Tags']['title']))
                    ->queryAll();
                $id = $id[0]['id'];
                return $id;
                $this->redirect('/admin/tags/update/id/'.$id);
            } else {
                return false;
            }
        }
    }

    public function actionAdd()
    {
        $model = new Tags();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/tags/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Tags::model()->findByPk($id);
                
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
//        $this->initSave($model);
        
        $this->render('update', $render);
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $model = Tags::model()->findByPk($id);
        $model->delete();
        $command = Yii::app()->db->createCommand();
        $command->delete('tags_projects', 'tag_id=:id', array(':id'=>$id));
        $this->redirect('/admin/tags');
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
