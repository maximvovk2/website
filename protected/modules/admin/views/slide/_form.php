    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'slides-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>

    <?php if($form->error($model, 'img')): ?>
        <div class="alert alert-error">
            <?php echo $form->error($model, 'img'); ?>
        </div>
    <?php endif; ?>

    <div class="control-group">
        <div class="controls">
            <?php echo $form->ckEditorRow(
                $model,
                'description',
                array(
                    'editorOptions' => array(
                        'fullpage' => 'js:true',
                        'width' => '840',
                        'resize_maxWidth' => '640',
                        'resize_minWidth' => '320'
                    )
                )
            ); ?>
        </div>
    </div>

    <div class="control-group">
        Форматы картинки JPG, JPEG, BMP, GIF, PNG
    </div>

    <div class="control-group">
        <?php echo $form->fileField($model, 'img'); ?>
    </div>

    <div class="controls">
        <?php echo CHtml::submitButton('Принять', array('class' => 'btn btn-save')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
