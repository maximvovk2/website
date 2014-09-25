<h2>Titles</h2>

<?php
$this->widget(
    'BGridView',
    array(
        'id'=>'successstories-grid',
        'dataProvider'=>$model->search(),
        'template'=>"{items}\n{pager}",
//        'filter'=>$model,
        'columns'=>array(
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
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/titles/add">Add</a>
