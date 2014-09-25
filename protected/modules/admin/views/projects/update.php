<div class="span4">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/projects">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
    <h2>Update Project</h2>
    <?php 
    $render = array(
        'model' => $model,
        'tech' => $tech,
        'tagsList' => $tagsList,
        'saveTags' => $saveTags,

    );
        if(isset($flag)){
            $render['flag'] = $flag;
        }
    $this->renderPartial('_form', $render); 
    ?>
</div>