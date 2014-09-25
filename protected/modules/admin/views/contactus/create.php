<?php
$this->breadcrumbs=array(
	'Contactuses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Contactus','url'=>array('index')),
array('label'=>'Manage Contactus','url'=>array('admin')),
);
?>

<h1>Create Contactus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>