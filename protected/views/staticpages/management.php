<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <ul class="breadcrumps group">
                        <li><a href="/">Home </a>&nbsp;&gt;&nbsp;&nbsp</li>
                        <li>Management</li>
                    </ul>
                    <h2>Management
                        <?php if ($doc = StaticpagesController::getDoc($modelTitle->id)): ?>
                            <a href="/popup/DocumentsAll?id=<?php echo $doc; ?>" style="line-height: 1.2em; font-size: 13px;" class="inline cboxElement"><img alt="" src="../../images/pdf-icon0.png" /></a>
                        <?php else: ?>
                            <br><br>
                        <?php endif; ?></h2>
                    <?php echo $modelStatic->text; ?>
                    <?php foreach($modelDynamic as $item) : ?>
                    <div class="block_management group">
                        <div class="managImg">
                            <?php if(is_file('images/management/'.$item->id.DIRECTORY_SEPARATOR.$item->img)): ?>
                            <img src="/images/management/<?php echo $item->id; ?>/<?php echo $item->img; ?>" alt="img">
                            <?php else: ?>
                            <img src="/images/management/0/nophoto.png" alt="img">
                            <?php endif; ?>
                        </div>
                        <div class="managText">
                                <p class="managTitle"><strong><?php echo $item->title; ?></strong></p>
                                <b><a href="mailto:<?php echo $item->email ?>">Send an Email</a></b>
                                <p class="managDesc"><?php echo $item->description; ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</div>