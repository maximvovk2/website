<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'documents-form',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),
)); ?>

<?php if($form->error($model, 'url')): ?>
    <div class="alert alert-error">
        <?php echo $form->error($model, 'url'); ?>
    </div>
<?php endif; ?>

<?php if($form->error($model, 'img')): ?>
    <div class="alert alert-error">
        <?php echo $form->error($model, 'img'); ?>
    </div>
<?php endif; ?>

<div class="control-group">
    <?php echo $form->label($model,'Ссылка на партнера*'); ?>
    <div class="controls">
        <?php echo $form->textField($model,'url', array('class' => 'input-xxlarge')); ?>
    </div>
</div>

<div class="control-group">
    Форматы картинки JPG, JPEG, BMP, GIF, PNG
</div>

<?php if(!empty($model->img)): ?>
    <div class="control-group">
        Картинка - <a href="/images/partners/<?php echo $model->id; ?>/<?php echo $model->img; ?>" target="_blank"><?php echo $model->img; ?></a>
    </div>
<?php endif; ?>

<div class="control-group">
    <?php echo $form->fileField($model, 'img'); ?>
</div>

<div class="controls">
    <?php echo CHtml::submitButton('Принять', array('class' => 'btn btn-save')); ?>
</div>

<?php $this->endWidget(); ?>
</div>
