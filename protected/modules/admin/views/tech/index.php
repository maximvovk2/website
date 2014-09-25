<h2>Technologies</h2>

<?php
$this->widget(
    'BGridView',
    array(
        'id'=>'tech-grid',
        'dataProvider'=>$techList->search(array('order' => 'position')),
        'template'=>"{items}\n{pager}",
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
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/tech/add">Add</a>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/tech/changefollowing"> Сhange orders following</a>
