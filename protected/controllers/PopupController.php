<?php

class PopupController extends Controller
{
    public $layout = 'clear';

    public function actionDocumentsAll()
    {
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        $file = Documents::model()->findAll();
        $this->render('documentsall', array(
            'files' => $file,
        ));
    }

    public function actionSummary()
    {
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        $this->render('summary');
    }
}
