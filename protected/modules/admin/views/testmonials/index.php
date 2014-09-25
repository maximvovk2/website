<h2>Testimonials</h2>

<?php
$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'id'=>'questions-grid',
        'dataProvider'=>$model->search(),
        'template'=>"{items}\n{pager}",
        'filter'=>$model,
        'columns'=>array(
            'title',
            'description',
            'dateCreate',
            'dateUpdate',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update}',
            ),
        ),
    )
);
?>
<!--<a class="btn" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/testmonials/add">Add</a>-->

