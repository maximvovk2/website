<?php
    $form=$this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id'=>'successstories-form',
            'enableAjaxValidation'=>true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )
    );
?>

<?php echo $form->label($model,'client*'); ?>
<?php
    $this->widget(
        'application.extensions.ckeditor.CKEditor',
        array(
            'model' => $model,
            'attribute' => 'client',
            'language' => 'en',
            'editorTemplate' => 'full',
            'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('successstories/browse')),'width'=>'840')

        )
    );
?>

<?php echo $form->label($model,'task*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'task',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('successstories/browse')),'width'=>'840')

    )
);
?>

<?php echo $form->label($model,'solution*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'solution',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('successstories/browse')),'width'=>'840')

    )
);
?>

<?php echo $form->label($model,'result*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'result',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('successstories/browse')),'width'=>'840')

    )
);
?>

<div class="control-group">

    <?php if(!empty($model->pic)): ?>
    Image:<br>
    <?php echo CHtml::image(DIRECTORY_SEPARATOR.$model->pic,
        "this is alt tag of image",
        array("width"=>"120px" ,"height"=>"120px"));
    ?>
    <?php if(!$model->isNewRecord): ?>
            <?php if ($model->pic != ''): ?>
                <p><?php  echo CHtml::link('Delete image', array("/admin/successstories/deletefile/", 'id'=>$model->id), array('confirm'=>'Are you sure?',)); ?></p>
            <?php endif; ?>
        <?php endif; ?>
    <?php else: ?>
        No Picture uploaded

    <?php endif; ?>

<br>
<p>Upload new image: Formats: JPG, JPEG, GIF, PNG. Max size: 200x200</p>
    <?php echo $form->fileField($model,'pic'); ?>
    <?php echo $form->error($model,'pic'); ?>
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
