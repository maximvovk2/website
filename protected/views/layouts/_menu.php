<?php
$menuItems = Navigation::menuItems($rootId, 2);
?>
<ul>
    <?php 
    foreach ($menuItems as $item) : ?>
    <li><?php if (!empty($item->url)): ?><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a><?php else : echo $item->title; endif; ?>
        <?php if (empty($item->url)) : ?>
            <?php $this->renderPartial('application.views.layouts._menu', array('rootId' => $item->id)); ?>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
