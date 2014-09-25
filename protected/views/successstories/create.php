<?php
/* @var $this SuccessstoriesController */
/* @var $model Successstories */

$this->breadcrumbs=array(
	'Successstories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Successstories', 'url'=>array('index')),
	array('label'=>'Manage Successstories', 'url'=>array('admin')),
);
?>

<h1>Create Successstories</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>