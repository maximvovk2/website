<?php
/* @var $this SuccessstoriesController */
/* @var $data Successstories */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('client')); ?>:</b>
	<?php echo CHtml::encode($data->client); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('task')); ?>:</b>
	<?php echo CHtml::encode($data->task); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('solution')); ?>:</b>
	<?php echo CHtml::encode($data->solution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('result')); ?>:</b>
	<?php echo CHtml::encode($data->result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pic')); ?>:</b>
<!--	--><?php //echo CHtml::encode($data->pic); ?>
    <?php echo CHtml::image(Yii::app()->getBaseUrl(true).'/'.$data->pic,$data->pic); ?>
	<br />


</div>