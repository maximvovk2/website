<?php
    $form=$this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
	        'id'=>'contactdata-form',
	        'enableAjaxValidation'=>false,
        )
    );
?>

<?php echo $form->textFieldRow($model,'general',array('class'=>'input-xxlarge','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'jobs',array('class'=>'input-xxlarge','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'partnership',array('class'=>'input-xxlarge','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'phone',array('class'=>'input-xxlarge','maxlength'=>50)); ?>
<?php echo $form->textFieldRow($model,'adress',array('class'=>'input-xxlarge')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
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
