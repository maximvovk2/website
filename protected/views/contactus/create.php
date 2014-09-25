<?php
/* @var $this ContactusController */
/* @var $model Contactus */

$this->menu=array(
	array('label'=>'List Contactus', 'url'=>array('index')),
	array('label'=>'Manage Contactus', 'url'=>array('admin')),
);
?>

<h1>Create Contactus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>