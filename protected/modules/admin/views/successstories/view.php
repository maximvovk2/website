<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/successstories">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back to Successstories</a>

<h2> Detail View </h2>

<?php
    $this->widget(
        'bootstrap.widgets.TbDetailView',
        array(
            'data'=>$model,
            'attributes'=>array(
                    'id',
                    'client',
                    'task',
                    'solution',
                    'result',
                    array (
                        'name'=>'pic',
                        'type'=>'raw',
                        'value'=>CHtml::image(Yii::app()->getBaseUrl(true).'/'.$model->pic,$model->pic,array('class'=>'storiesImg')),
                        'htmlOptions'=>array('class'=>'storiesImg'),
                    ),
            ),


        )
    );
?>

