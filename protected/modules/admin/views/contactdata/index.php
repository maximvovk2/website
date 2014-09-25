<h2>Contact Data</h2>

<?php
    $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'id'=>'contactdata-grid',
            'dataProvider'=>$model->search(),
            'template'=>"{items}\n{pager}",
            'columns'=>array(
                'general',
                'jobs',
                'partnership',
                'phone',
                'adress',
                'dateCreate',
            'dateUpdate',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'template'=>'{delete}{update}',
                    'template'=>'{update}',
                ),
            ),
        )
    );
?>
<!--<a class="btn" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/contactdata/create">Добавить</a>-->