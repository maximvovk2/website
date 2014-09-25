<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/staticpages">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
<h2>Update static content for  "<?php echo $model->title; ?>"</h2>
<?php 
       $render = array('model' => $model);
        if(isset($flag)){
            $render['flag'] = $flag;
        }
$this->renderPartial('form', $render); ?>


