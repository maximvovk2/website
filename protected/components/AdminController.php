<?php

class AdminController extends Controller
{


    public $active;
    public $pageSize = 50;

    public function init()
    {
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']);
        }
        $this->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);

        return parent::init();
    }

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array('index', 'edit', 'delete', 'add'),
                'users'=>array('?'),
            ),
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