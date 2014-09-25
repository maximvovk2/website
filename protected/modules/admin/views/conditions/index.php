<h2>Conditions</h2>

<?php
$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'id'=>'questions-grid',
        'dataProvider'=>$model->search(),
        'template'=>"{items}\n{pager}",
        //'filter'=>$model,
        'columns'=>array(
            'title',
            'description', 
            'dateCreate',
            'dateUpdate',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update}',
//                'template'=>'{delete}{update}',
            ),
        ),
    )
);
?>
<!--<a class="btn" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/conditions/add">Add</a>-->
