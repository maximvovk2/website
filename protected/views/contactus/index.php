<h1>Contact Us</h1>

<p>General queries: <?php echo $model2->general;?></p>
<p>Job orrortunities: <?php echo $model2->jobs;?></p>
<p>Partnership: <?php echo $model2->partnership;?></p>
<p>Call: <?php echo $model2->phone;?></p>
<p>Adress: <?php echo $model2->adress;?></p>

<?php $this->renderPartial('_form', array('model'=>$model)); ?> 







