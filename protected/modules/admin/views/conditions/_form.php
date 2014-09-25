<?php
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'=>'conditions-form',
        'enableAjaxValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
?>


<?php echo $form->label($model,'Title*'); ?>
<?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>

<?php echo $form->label($model,'description*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'description',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('vacancies/browse')),'width'=>'840')

    )
);
?>

<!--        --><?php //echo $form->ckEditorRow(
//            $model,
//            'description',
//            array(
//                'editorOptions' => array(
//                    'fullpage' => 'js:true',
//                    'width' => '840',
//                    'resize_maxWidth' => '640',
//                    'resize_minWidth' => '320'
//                )
//            )
//        ); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array('buttonType' => 'reset', 'label' => 'Reset')
    );
    ?>
</div>
<?php 
    if(isset($flag)){
        if($flag){
            ?>
                <script type="text/javascript">
                    function changes_applied() {
                        alert( "Your changes have been applied" );
                    }
                    $( document ).ready(function() {
                        setTimeout(changes_applied, 1000);
                    });
                 </script>
            <?php
        }
    }
?>
<?php $this->endWidget(); ?>
</div>
