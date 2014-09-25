<?php /** @var TbActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'horizontalForm',
            'type' => 'horizontal',
        )
    );
?>
<?php
        $model = new Staticpages();
        echo $form->ckEditorRow(
                $model,
                'text',
                array(
                    'editorOptions' => array(
                                        'fullpage' => 'js:true',
                                        'width' => '640',
                                        'resize_maxWidth' => '640',
                                        'resize_minWidth' => '320'
                                        )
                )
             );
?>
<?php
    $this->endWidget();
    unset($form);
?>