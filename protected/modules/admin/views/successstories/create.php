<?php
$this->breadcrumbs=array(
	'Successstories'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Successstories','url'=>array('index')),
array('label'=>'Manage Successstories','url'=>array('admin')),
);
?>

<h1>Create Success story</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>