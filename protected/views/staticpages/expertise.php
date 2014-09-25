<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <?php echo $modelStatic->text; ?>
                    <div class="five-columns">
                        <?php foreach($modelTech as $item) : ?>
                        <div class="col">
                            <a href="/staticpages/Expertise/<?php echo $item->title; ?>">
                                <img src="/images/tmp/partner1.jpg" alt="#"/>
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