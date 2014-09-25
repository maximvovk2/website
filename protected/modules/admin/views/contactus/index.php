<h2>Questions</h2>

<?php
    $this->widget(
        'BGridView',
        array(
            'id'=>'contactus-grid',
            'dataProvider'=>$model->search(),
            'template'=>"{items}\n{pager}",
            'filter'=>$model,
            'columns'=>array(
                'id',
                'name',
                'email',
                'subject',
                'body',
                'date',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{delete}{view}',
                ),
            ),
        )
    );
?>

