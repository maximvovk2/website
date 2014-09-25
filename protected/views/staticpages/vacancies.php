<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <ul class="breadcrumps group">
                        <li><a href="/">Home </a>&nbsp;&gt;&nbsp;&nbsp</li>
                        <li>Vacancies</li>
                    </ul>
<!--                    <div class="vacancy-image">-->
<!--                        <div class="holder">-->
<!--                            <div class="frame">-->
<!--                                <img class="main-image" src="/images/img-vacancy.jpg" alt="img">-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    <h2>
                        <?php if ($doc = StaticpagesController::getDoc($modelTitle->id)): ?>
                            Here you can download our vacancies <a href="/popup/DocumentsAll?id=<?php echo $doc; ?>" style="line-height: 1.2em; font-size: 13px;" class="inline cboxElement"><img alt="" src="../../images/pdf-icon0.png" /></a>
                        <?php else: ?>

                        <?php endif; ?>
                    </h2>
                    <?php echo $modelStatic->text; ?>
                    <div class="vacancy-holder">
                        <?php foreach($modelDynamic as $item): ?>
                        <article class="vacancy-item">
                            <header>
                                <h2 class="col-heading"><?php echo $item->title; ?></h2>
                                <a href="/popup/summary?id=<?php echo $item->id; ?>" class="btn-square inline cboxElement">Oh, I'm exactly that Guy</a>
                            </header>
                            <?php echo $item->description; ?>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div id="bg"><img src="images/backgrounds/bg-body1.jpg" alt="" /></div>