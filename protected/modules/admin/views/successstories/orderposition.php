<div class="span9" id="content">
    <div class="row-fluid">
        <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"><h3>Success stories</h3></div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">
                    <table class="table table-striped table-bordered table-condensed tech" id="example_successstories">
                        <thead>
                        <tr>
                            <th>Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model as $item) : ?>
                            <tr id="id-<?php echo $item->id; ?>">
                                <td><?php echo $item->task; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a class="btn" href="<?php echo Yii::app()->getBaseUrl(true)?>/admin/successstories"> Return back</a>
</div>
