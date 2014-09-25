<div class="span4">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/partners">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
    <h2>Update partner</h2>
    <?php $this->renderPartial('_form', array('model' => $model)); ?>