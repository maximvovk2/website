
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'documents-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

<?php if($form->error($model, 'title')): ?>
    <div class="alert alert-error">
        <?php echo $form->error($model, 'title'); ?>
    </div>
<?php endif; ?>

<div class="control-group">
    <?php echo $form->label($model,'Title*'); ?>
    <div class="controls">
        <?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>
    </div>
</div>

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