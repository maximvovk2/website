<?php

class StaticpagesController extends AdminController
{
    public function init() {
        $this->active = 'staticpages';
        parent::init();
    }

    public function actionIndex() {
        $model = new Staticpages('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Staticpages'])) {
            $model->attributes = $_GET['Staticpages'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    protected function initSave(Staticpages $model)
    {
        if (isset($_POST['Staticpages'])) {
            $model->attributes = $_POST['Staticpages'];
            if ($model->save()) {
                $id = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('staticpages')
                    ->where('title = :title', array(':title' => $_POST['Staticpages']['title']))
                    ->queryAll();
                $id = $id[0]['id'];
                return $id;
                
            }
        }
    }

    public function actionAdd() {
        $model = new Staticpages();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/staticpages/update/id/'.$id);
        }

        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = Staticpages::model()->findByPk($id);
        $render = array('model' => $model);
        if($this->initSave($model)){
            $render['flag'] = true;
        }
        
        $this->render('edit', $render);
    }

    public function actionDelete($id) {

          if(Yii::app()->request->isPostRequest)
            {
                $this->loadModel($id)->delete();
                if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    public function loadModel($id)
    {
        $model=Staticpages::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if ($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('staticpages', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }

    }
    public function filters() {
        return array(
            array('ext.yiibooster..filters.BootstrapFilter - delete')
        );
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