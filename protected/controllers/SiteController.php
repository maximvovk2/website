<?php

class SiteController extends Controller
{
    public $layout = 'main';
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $conditionsList = Conditions::model()->findAll(array('order' => 'position'));
        $testmonialsList = Testmonials::model()->findAll();
        $techList = Tech::model()->findAll(array('limit' => 5));
//        $techList = Tech::model()->findAll(array('order' => 'position', 'limit' => 5));
        $clientsList = Clients::model()->findAll();
        $modelTitle = Yii::app()->db->createCommand()
            ->select('*')
            ->from('titles')
            ->queryAll();


        $this->render('index', array(
                'techList' => $techList,
                'conditionsList' => $conditionsList,
                'clientsList' => $clientsList,
                'testmonialsList' => $testmonialsList,
                'modelTitle'=>$modelTitle,

            )
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public static function getDoc($id)
    {
        $idDoc = Yii::app()->db->createCommand()
            ->select('id')
            ->from('documents')
            ->where('idTitle = :id', array(':id' => $id))
            ->queryAll();
        if (count($idDoc)==1)
        {
            return $idDoc[0]['id'];
        } else
        {
            return false;
        }

    }

    public static function getTitle ($string, $model)
    {
        $id = false;
        foreach ($model as $item)
            if ($string == $item['title'])
            {
                $id = $item['id']; break;
            }
        return $id;
    }
}
