<h2>Successstories</h2>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
    'template'=>"{items}\n{pager}",
	'itemView'=>'_view',
)); ?>
