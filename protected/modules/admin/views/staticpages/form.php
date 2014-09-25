<?php
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id'=>'successstories-form',
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )
    );
?>


<?php echo $form->textFieldRow($model, 'title', array('class' => "input-xxlarge")); ?>

<?php

    if (!$model->isNewRecord){
        echo $form->textFieldRow(
            $model,
            'activelink',
            array(
                'disabled' => true,
                'class' => "input-xxlarge",
            )
        );
        echo $form->textFieldRow(
            $model,
            'dateCreate',
            array(
                'disabled' => true,
                'class' => "input-xxlarge",
            )
        );
        echo $form->textFieldRow(
            $model,
            'dateUpdate',
            array(
                'disabled' => true,
                'class' => "input-xxlarge",
            )
        );
    } else {
       $Staticpages['dateCreate'] = date("F j, Y");
     }
?>

<?php echo $form->label($model,'text*'); ?>
<?php
$this->widget(
    'application.extensions.ckeditor.CKEditor',
    array(
        'model' => $model,
        'attribute' => 'text',
        'language' => 'en',
        'editorTemplate' => 'full',
        'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('staticpages/browse')),'width'=>'840')

    )
);
?>


    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'label' => 'Save'
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array('buttonType' => 'reset', 'label' => 'Reset')
        ); ?>
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

<?php
$this->endWidget();
unset($form);