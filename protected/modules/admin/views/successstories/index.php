<h2>Success stories</h2>

<?php
$this->widget(
    'BGridView',
    array(
        'id'=>'successstories-grid',
        'dataProvider'=>$model->search(array('order' => 'position')),
        'template'=>"{items}\n{pager}",
        'filter'=>$model,
        'columns'=>array(
            //        'id',
            'position',
            'client',
            'task',
            'solution',
            'result',  
            'dateCreate',
            'dateUpdate',
//                'pic',
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{delete}{update}{view}',
            ),
        ),
    )
);
?>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/successstories/update">Add</a>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/successstories/changefollowing"> Сhange orders following</a>
