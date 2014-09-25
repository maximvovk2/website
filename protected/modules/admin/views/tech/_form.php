    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'documents-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>

<?php echo $form->label($model,'Title*'); ?>
<?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>

<?php echo $form->label($model,'description*'); ?><label>Recommended picture size: 120x120</label>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'description',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('tech/browse')),'width'=>'840')

    )
);
?><?php echo $form->label($model,'info*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'info',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('tech/browse')),'width'=>'840')

    )
);
?>
<?php //echo $form->ckEditorRow(
//    $model,
//    'description',
//    array(
//        'editorOptions' => array(
//            'fullpage' => 'js:true',
//            'width' => '840',
//            'resize_maxWidth' => '640',
//            'resize_minWidth' => '320'
//        )
//    )
//); ?>
<!---->
<?php //echo $form->ckEditorRow(
//    $model,
//    'info',
//    array(
//        'editorOptions' => array(
//            'fullpage' => 'js:true',
//            'width' => '840',
//            'resize_maxWidth' => '640',
//            'resize_minWidth' => '320'
//        )
//    )
//); ?>


<!--    <div class="control-group list">-->
<!--        <label> Теги: </label>-->
<!--        <div class="elements">-->
<!--            --><?php //if (!empty($list)) : ?>
<!--                --><?php //foreach ($list as $item) : ?>
<!--                    <div class="input-list">-->
<!--                        <span>--><?php //echo $item->title; ?><!--</span>-->
<!--                        <input type="hidden" name="list[]" value="--><?php //echo $item->title; ?><!--"/>-->
<!--                        <a href="#" title="Delete element" class="icon-remove delete-element"> </a>-->
<!--                    </div>-->
<!--                --><?php //endforeach; ?>
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <a title="Add element" href="#" class="icon-plus add-element"></a>-->
<!--    </div>-->

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
