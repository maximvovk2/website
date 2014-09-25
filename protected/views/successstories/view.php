<?php
/* @var $this SuccessstoriesController */
/* @var $model Successstories */

$this->breadcrumbs=array(
	'Successstories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Successstories', 'url'=>array('index')),
	array('label'=>'Create Successstories', 'url'=>array('create')),
	array('label'=>'Update Successstories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Successstories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Successstories', 'url'=>array('admin')),
);
?>

<h1>View Successstories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'client',
		'task',
		'solution',
		'result',
		'pic',
	),
)); ?>
