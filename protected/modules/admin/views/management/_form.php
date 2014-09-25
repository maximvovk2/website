    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'documents-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>

    <div class="control-group">
        <?php echo $form->label($model,'Title*'); ?>
        <div class="controls">
            <?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->label($model,'Email*'); ?>
        <div class="controls">
            <?php echo $form->textField($model,'email', array('class' => 'input-xxlarge')); ?>
        </div>
    </div>

    <?php echo $form->label($model,'description*'); ?>
    <?php
    $this->widget(
        'application.extensions.ckeditor.CKEditor',
        array(
            'model' => $model,
            'attribute' => 'description',
            'language' => 'en',
            'editorTemplate' => 'full',
            'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('management/browse')),'width'=>'840')

        )
    );
    ?>
<!--    <div class="control-group">-->
<!--        <div class="controls">-->
<!--            --><?php //echo $form->ckEditorRow(
//                $model,
//                'description',
//                array(
//                    'editorOptions' => array(
//                        'fullpage' => 'js:true',
//                        'width' => '840',
//                        'resize_maxWidth' => '640',
//                        'resize_minWidth' => '320'
//                    )
//                )
//            ); ?>
<!--        </div>-->
<!--    </div>-->

<!--    <div class="control-group">-->
<!--        <p>Formats: JPG, JPEG, BMP, GIF, PNG.</p>-->
<!--        <p>Recommended size: 120x120</p>-->
<!--    </div>-->
<!---->
<!--    --><?php //if(!empty($model->img)): ?>
<!--    <div class="control-group">-->
<!--        Picture - <a href="/images/management/--><?php //echo $model->id; ?><!--/--><?php //echo $model->img; ?><!--" target="_blank">--><?php //echo $model->img; ?><!--</a>-->
<!--        --><?php //if(!$model->isNewRecord): ?>
<!--            --><?php //if ($model->img != ''): ?>
<!--               --><?php // echo CHtml::link('', array("/admin/management/deletefile/", 'id'=>$model->id), array('confirm'=>'Are you sure?', 'class'=>'icon-trash')); ?>
<!--            --><?php //endif; ?>
<!--        --><?php //endif; ?>
<!--    </div>-->
<!--    --><?php //else: ?>
<!--    <div class="control-group">-->
<!--      No Picture uploaded-->
<!--    </div>-->
<!--    --><?php //endif; ?>
<!---->
<!--    <div class="control-group">-->
<!--        --><?php //echo $form->fileField($model, 'img'); ?>
<!--    </div>-->


    <div class="control-group">
        <?php if(!empty($model->img)): ?>
            Image:<br>
            <?php
                echo CHtml::image(
                    "/images/management/".$model->id.DIRECTORY_SEPARATOR.$model->img,
                    "this is alt tag of image",
                    array("width"=>"120px" ,"height"=>"120px"));
            ?>
            <?php if(!$model->isNewRecord): ?>
                <?php if ($model->img != ''): ?>
                    <p><?php echo CHtml::link('Delete image', array("/admin/management/deletefile/", 'id'=>$model->id), array('confirm'=>'Are you sure?', )); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        <?php else: ?>
            No Picture uploaded

        <?php endif; ?>

        <br>
        <p>Upload new image: Formats: JPG, JPEG, GIF, PNG. Recommended size: 120x120</p>
        <?php echo $form->fileField($model,'img'); ?>
        <?php echo $form->error($model,'img'); ?>
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
