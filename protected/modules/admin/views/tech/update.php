<div class="span4">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/tech">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
    <h2>Update technology</h2>
    <?php 
    $render = array(
        'model' => $model,
        'list' => $list,
    );
        if(isset($flag)){
            $render['flag'] = $flag;
        }
    $this->renderPartial('_form', $render); 
    
    ?>
</div>
