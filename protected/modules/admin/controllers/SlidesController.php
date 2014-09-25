<?php
class SlidesController extends AdminController
{
    public function init() {
        $this->active = 'slides';
        parent::init();
    }

    public function actionIndex() {
        $model = Slides::model()->findAll(array('order' => 'position'));
        $this->render('application.modules.admin.views.slide.index', array('model' => $model));
    }

    function initSave(Slides $model)
    {
        if (isset($_POST['Slides'])) {
            // Save process
            $oldImg = $model->img;
            $model->attributes = $_POST['Slides'];
            $uploadFile = CUploadedFile::getInstance($model, 'img');
            if($uploadFile !== null) {
                $model->img = $uploadFile;
            }
            if ($model->save()) {
                if (!empty($uploadFile)){
                    if(!is_dir('slides/'. $model->id)){
                        mkdir('slides/'. $model->id);
                    }
                    $model->img->saveAs('slides/'. $model->id . '/' . $model->img->getName());
                    if(is_file('slides/'. $model->id . '/' . $oldImg)) {
                        unlink('slides/'. $model->id . '/' . $oldImg);
                    }
                }
//                $this->redirect('/admin/slides');
            }
        }
    }

    public function actionAdd()
    {
        $model = new Slides();
        $this->initSave($model);
        $this->render('application.modules.admin.views.slide.add', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = Slides::model()->findByPk($id);
        $this->initSave($model);
        $this->render('application.modules.admin.views.slide.edit', array('model' => $model));
    }

    public function actionDelete($id) {
        $id = (int)$id;
        if ($id == 0) {
            throw new CHttpException(404, 'Invalid request');
        }
        $model = Slides::model()->findByPk($id);
        if($model->delete()){
            $this->removeDirectory('slides/'. $model->id);
        }

        $this->redirect('/admin/slides');
        exit();
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('slides', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
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
