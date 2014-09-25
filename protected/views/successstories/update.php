<?php
/* @var $this SuccessstoriesController */
/* @var $model Successstories */

$this->breadcrumbs=array(
	'Successstories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Successstories', 'url'=>array('index')),
	array('label'=>'Create Successstories', 'url'=>array('create')),
	array('label'=>'View Successstories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Successstories', 'url'=>array('admin')),
);
?>

<h1>Update Successstories <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>