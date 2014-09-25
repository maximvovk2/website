<h2>Clients</h2>

<?php
$this->widget(
    'BGridView',
    array(
        'id'=>'clients-grid',
        'dataProvider'=>$model->search(array('order' => 'position')),
        'template'=>"{items}\n{pager}",
        'filter'=>$model,
        'columns'=>array(
            'position',
            'title',
            'dateCreate',
            'dateUpdate',

            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{delete}{update}',
            ),
        ),
    )
);
?>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/Clients/add">Add</a>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/Clients/changefollowing"> Сhange orders following</a>
