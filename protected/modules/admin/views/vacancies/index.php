<h2>Vacancies</h2>

<?php
$this->widget(
    'BGridView',
    array(
        'id'=>'vacancies-grid',
        'dataProvider'=>$model->search(array('order' => 'position')),
        'template'=>"{items}\n{pager}",
//        'filter'=>$model,
        'columns'=>array(
            //        'id',
            'position',
            'title',
            'description',    
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
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/vacancies/add">Add</a>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/vacancies/changefollowing"> Сhange orders following</a>