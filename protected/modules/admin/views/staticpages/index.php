<h2>Static content</h2>
<?php
    $this->widget(
        'BGridView',
        array(
            'id'=>'staticpages-grid',
            'dataProvider'=>$model->search(),
            'template'=>"{items}\n{pager}",
            'filter'=>$model,
            'columns'=>array(
        //        'id',
                array(
                    'name' => 'title',
                    'value' => 'CHtml::link(
                                    $data->title,
//                                    array("/staticpages/index","page"=>$data->title),
                                    array("/$data->title"),
                                    array("target"=>"_blank")
                                )',
                    'type' => 'raw',
                ),
                'text',
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
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/staticpages/add">Add</a>

