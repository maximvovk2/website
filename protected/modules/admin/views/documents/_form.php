
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'documents-form',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
    )); ?>


    <div class="control-group">
        <?php echo $form->label($model,'Title*', array('for' => 'Documents_title')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'title', array('class' => 'input-xxlarge')); ?>
        </div>
    </div>

    <div class="control-group">
<!--        --><?php //echo $form->label($model,'Connected with'); ?>
        <label>Connected title</label>
        <div class="controls">
            <?php echo $form->dropDownList($model,'idTitle', Titles::titleList(), array('empty' => '' )); ?>
        </div>
    </div>
    <?php if($form->error($model, 'idTitle')): ?>
        <div class="alert alert-error">
            <?php echo $form->error($model, 'idTitle'); ?>
            <?php
                if (isset ($_POST['Documents']['idTitle']))
            {
                $mas = Documents::titleDocument ($_POST['Documents']['idTitle']);

                echo "Document name:&nbsp;".$mas[0]."&nbsp;-&nbsp;".CHtml::link('Edit', array("/admin/documents/update/", 'id'=>$mas[1],),array('target' => '_blank'));
            } ?>
<!--            --><?php //echo "<pre>".var_dump($_POST)."</pre>"; die; ?>
        </div>
    <?php endif; ?>

    <?php echo $form->label($model,'description*'); ?>
    <?php
    $this->widget(
        'application.extensions.ckeditor.CKEditor',
        array(
            'model' => $model,
            'attribute' => 'description',
            'language' => 'en',
            'editorTemplate' => 'full',
            'options'=>array('filebrowserBrowseUrl'=>CHtml::normalizeUrl(array('documents/browse')),'width'=>'840')

        )
    );
    ?>
<!---->
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

    <div class="control-group">
        Only PDF format
    </div>

    <div class="control-group">
    <?php
        if(!empty($model->file)){
            echo '<a href="/documents/' . $model->file . '">' . $model->file . '</a>';
        }
    ?>
    </div>

    <div class="control-group">
        <?php echo $form->fileField($model, 'file'); ?>
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