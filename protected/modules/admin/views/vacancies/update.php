<div class="span4">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/vacancies">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
    <h2>Update vacancy</h2>
    <?php 
    $render = array('model' => $model);
        if(isset($flag)){
            $render['flag'] = $flag;
        }
    $this->renderPartial('_form', $render); 
    
    ?>
</div>