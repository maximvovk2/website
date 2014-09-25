<?php
//
//    foreach($model as $item){
//	    echo '<a href="expertise/projects/tech/'. $item->title .'">'. $item->title .'</a>';
//	    echo '<br />';
//    }
//?>

<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <h2>Our Expertise
                    <?php if ($doc = ExpertiseController::getDoc($modelTitle->id)): ?>
                        <a href="/popup/DocumentsAll?id=<?php echo $doc; ?>" style="line-height: 1.2em; font-size: 13px;" class="inline cboxElement"><img alt="" src="../../images/pdf-icon0.png" /></a></h2>
                    <?php else: ?>
                    <br><br>
                    <?php endif; ?>
                    <?php echo $modelStatic->text; ?>
                    <div class="five-columns">
                        <?php foreach($modelTech as $item) : ?>
                            <div class="col">
                                <a href="/expertise/projects/tech/<?php echo $item->title; ?>">
                                <h3><?php echo $item->title; ?></h3>
                                <?php echo $item->description; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>