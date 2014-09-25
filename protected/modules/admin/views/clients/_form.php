<?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'clients-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
    ));
?>

<?php //if($form->error($model, 'title')): ?>
<!--    <div class="alert alert-error">-->
<!--        --><?php //echo $form->error($model, 'title'); ?>
<!--    </div>-->
<?php //endif; ?>

<div class="control-group">
    <?php echo $form->label($model,'Title*'); ?>
    <div class="controls">
        <?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->label($model,'Link'); ?>
    <div class="controls">
        <?php echo $form->textField($model,'link', array('class' => 'input-xxlarge')); ?>
    </div>
</div>

<?php if(!empty($model->logo)): ?>
    Image:<br>
    <?php echo CHtml::image(DIRECTORY_SEPARATOR.$model->logo,
        "Cannot load logo",
        array("width"=>"120px" ,"height"=>"120px")); ?>
    <?php if(!$model->isNewRecord): ?>
        <?php if ($model->logo != ''): ?>
            <p><?php  echo CHtml::link('Delete image', array("/admin/Clients/deletefile/", 'id'=>$model->id), array('confirm'=>'Are you sure?',)); ?></p>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    No Picture uploaded

<?php endif; ?>

<br>
<p>Upload new logo: Formats: JPG, JPEG, GIF, PNG. Size: 120x120</p>
<?php echo $form->fileField($model,'logo'); ?>
<?php echo $form->error($model,'logo'); ?>


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
