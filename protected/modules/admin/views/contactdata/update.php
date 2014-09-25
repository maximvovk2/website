<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contactdata">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>

<h1>Update Contact Data</h1>
<?php 
$render = array('model' => $model);
        if(isset($flag)){
            $render['flag'] = $flag;
        }
echo $this->renderPartial('_form',$render);

?>