<div class="span4">
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/slides">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
    <h2>Change slide</h2>
    <?php $this->renderPartial('application.modules.admin.views.slide._form', array(
        'model' => $model
    )); ?>