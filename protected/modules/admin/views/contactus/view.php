<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/contactus">&lt;&nbsp;&lt;&nbsp;&lt;&nbsp; Back </a>
<h2>Detail view for question №<?php echo $model->id; ?></h2>

<?php
    $this->widget(
        'bootstrap.widgets.TbDetailView',
        array(
            'data'=>$model,
            'type' => array('condensed', 'striped', 'bordered'),

            'attributes'=>array(
                    'id',
                    'name',
                    'email',
                    'subject',
                    'body',
                    'date',
            ),
        )
    );
?>
