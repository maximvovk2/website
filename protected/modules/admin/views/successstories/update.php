<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/successstories">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
<h2>Success story <?php echo $model->id; ?></h2>

<?php

    echo $this->renderPartial('_form',array('model'=>$model,'flag' =>$flag)); 

?>