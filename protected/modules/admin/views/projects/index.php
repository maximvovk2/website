<h2>Projects</h2>

<?php
    $this->widget(
        'BGridView',
        array(
            'id'=>'projects-grid',
            'dataProvider'=>$model->search(array('order' => 'position')),
            'template'=>"{items}\n{pager}",
//            'filter'=>$model,
            'columns'=>array(
                'position',
                'title',
                'dateCreate',
                'dateUpdate',                
//                'description',
//                array(
//                    'name'  => 'Tech',
//                    'type'  => 'raw',
//                    'value' => '$data->getTech()',
//                ),
//                array( 'name'=>'technology', 'value'=>'$data->getTech()' ),

                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{delete}{update}',
                ),
            ),
        )
    );
?>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/projects/add">Add</a>
<a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/projects/changefollowing"> Сhange orders following</a>


<!--<div class="span9" id="content">-->
<!--    <div class="row-fluid">-->
<!--        <div class="block">-->
<!--            <div class="navbar navbar-inner block-header">-->
<!--                <div class="muted pull-left">Проекты</div>-->
<!--            </div>-->
<!--            <div class="block-content collapse in">-->
<!--                <div class="span12">-->
<!--                    <table class="table table-striped table-bordered table-condensed projects" id="example">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>Название</th>-->
<!--                            <th>Технологии</th>-->
<!--                            <th style="text-align: right;">Действия</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        --><?php //foreach ($projectsList as $project) : ?>
<!--                            <tr id="id---><?php //echo $project->id; ?><!--">-->
<!--                                <td>--><?php //echo $project->title; ?><!--</td>-->
<!--                                <td>-->
<!--                                    --><?php //$str = '';
//                                        foreach ($project->tech as $tech) {
//                                            $str .= ' ' . $tech->title . ',';
//                                        }
//                                        $str = rtrim($str, ',');
//                                        echo $str;
//                                    ?>
<!--                                </td>-->
<!--                                <td>-->
<!--                                    <div style="float:right;">-->
<!--                                        <a title="Редактировать" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/projects/edit/id/--><?php //echo $project->id;?><!--" class="icon-pencil"></a>-->
<!--                                        <a title="Удалить" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/projects/delete/id/--><?php //echo $project->id;?><!--" class="icon-trash"></a>-->
<!--                                    </div>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //endforeach; ?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--                <a class="btn" href="--><?php //echo Yii::app()->getBaseUrl(true)?><!--/admin/projects/add">Добавить</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->