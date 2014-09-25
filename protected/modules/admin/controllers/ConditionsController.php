<?php

class ConditionsController extends AdminController
{
    public function init() {
        $this->active = 'conditions';
        parent::init();
    }

    public function actionIndex() {
//        $model = Conditions::model()->findAll(array('order' => 'position'));
        $model = new Conditions('search');
        $this->render('index', array('model' => $model));
    }

    function initSave(Conditions $model)
    {
        if (isset($_POST['Conditions'])) {
            // Save process
            $model->attributes = $_POST['Conditions'];
//            if ($model->save()) { return true;
////                $this->redirect('/admin/conditions');
//            }
            if (!$model->IsNewRecord)
            {
                if ($model->save())
                {
                    return true;
                }
            } else
            {
                if ($model->save())
                {

                    $id = Yii::app()->db->createCommand()
                        ->select('id')
                        ->from('conditions')
                        ->where('title = :title', array(':title' => $_POST['Conditions']['title']))
                        ->queryAll();
                    $id = $id[0]['id'];
                    return $id;
                } else {
                    return false;
                }
            }
        }
    }

    public function actionAdd()
    {
        $model = new Conditions();
        $id = $this->initSave($model);
        if($id){
            $this->redirect('/admin/conditions/update/id/'.$id);
        }
        $this->render('add', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Conditions::model()->findByPk($id);
                
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
        $model = Conditions::model()->findByPk($id);
        $model->delete();
        header('Location: /admin/conditions');
        exit();
    }

    public function actionSaveOrder() {
        $request = Yii::app()->request;
        if($request->isAjaxRequest) {
            $order = $request->getQuery('id');
            fb($order);
            foreach ($order as $id => $item) {
                Yii::app()->db->createCommand()->update('conditions', array('position' => $id), 'id = ' . $item);
            }
            echo CJavaScript::jsonEncode(array('order' => $order));
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Неправильный запрос');
        }
    }
}