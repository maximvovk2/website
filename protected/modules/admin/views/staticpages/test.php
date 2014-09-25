<?php
if (isset($result)) : ?>
    <div class="alert alert-success">
        <?php echo $result; ?>
    </div>
<?php else : ?>
    <div class="span4">
        <h2>Добавление страницы</h2>
        <form action="" method="post">
            <?php if (isset($error)) : ?>
                <div class="alert alert-error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <div class="control-group">
                <label>Название</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="title" />
                    <?php echo $form->textFieldRow(
                        $model,
                        'title',
                        array(
                            'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.',
                            'class' => "input-xxlarge",
                            'placeholder' => 'text for placeholder',
                        )
                    ); ?>
                </div>
            </div>
            <div class="control-group">
                <label>Ссылка</label>
                <div class="controls">
                    <input type="text" class="input-xxlarge" name="activelink" />
                </div>
            </div>
            <div class="control-group">
                <label>Текст</label>
                <div class="controls">
                    <?php $this->widget('application.extensions.ckeditor.CKEditor', array(
                        'model' => $model,
                        'attribute'=>'text',
                        'language'=>'ru',
                        'editorTemplate'=>'full', ));
                    ?>

                </div>
            </div>
            <label>Другое</label>
            <div class="controls">
                <input type="text" class="input-xxlarge" name="etc" />
            </div>

            <div class="controls">
                <input type="submit" class="btn btn-save" value="Добавить" />
            </div>


        </form>
    </div>
<?php endif; ?> -->