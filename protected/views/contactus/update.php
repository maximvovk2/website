<?php
/* @var $this ContactusController */
/* @var $model Contactus */

$this->breadcrumbs=array(
	'Contactuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Contactus', 'url'=>array('index')),
	array('label'=>'Create Contactus', 'url'=>array('create')),
	array('label'=>'View Contactus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Contactus', 'url'=>array('admin')),
);
?>

<h1>Update Contactus <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>