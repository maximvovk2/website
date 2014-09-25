<?php
$menuItems = Navigation::menuItems($rootId, 3);
?>


<?php foreach ($menuItems as $item) : ?>
    <?php if (empty($item->url)): ?>
        <div class="col">
            <h3><?php echo $item->title; ?></h3>
    <?php endif; ?>

        <?php if (empty($item->url)): ?>
            <ul>
                <?php $this->renderPartial('application.views.layouts._footer', array('rootId' => $item->id)); ?>
            </ul>
        <?php else : ?>
            <li>
                <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
            </li>
        <?php endif; ?>

    <?php if (empty($item->url)): ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

