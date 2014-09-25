<body>
<div id="wrapper" class="header-small">
    <header id="header">
        <div class="header-frame">
            <strong class="logo"><a href="/">CHI software</a></strong>
            <nav id="nav">
                <ul>
                    <li class="nav"><a href="/#company">Company</a></li>
                    <li class="nav"><a href="/#tech">TECHNOLOGIES</a></li>
                    <li class="add active"><a href="/projects">PROJECTS</a></li>
                    <li class="nav"><a href="/#vacancies">Vacancies</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="portfolio-container">
        <?php if ($tech) : ?>
            <?php foreach ($tech as $techBlock) : ?>
                <div class="portfolio-holder" id="<?php echo Controller::str2url($techBlock->title) ?>">
                    <div class="header-section">
                        <h1><?php echo $techBlock->title; ?> Projects</h1>
                    </div>
                    <section class="portfolio">
                        <?php if ($techBlock->projects) : ?>
                            <?php foreach ($techBlock->projects as $project) : ?>
                                <div class="item">
                                    <?php if (!isset($project->projectsPics[0]->url)) : ?>
                                        <div class="blank">&nbsp;</div>
                                    <?php else :
                                    $preview = $project->projectsPics[0];
                                    foreach ($project->projectsPics as $pic) {
                                        if ($pic->preview == 1) {
                                            $preview = $pic;
                                        }
                                    } ?>
                                        <img alt=""
                                             src="<?php echo Yii::app()->getBaseUrl() . $preview->url; ?>">
                                    <?php endif; ?>
                                    <a class="holder"
                                       href="/projects/view/project/<?php echo $project->url; ?>/tech/<?php echo $techBlock->url; ?>/id/<?php echo $project->id; ?>">
                                        <h1><?php echo $project->title; ?></h1>

                                        <p><?php echo $project->description; ?></p>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </section>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    $(window).load(function() {
        var reg = /#[a-zA-Z0-9_-]*/;
        var test = reg.exec(location.href);
        if (test) {
            var anchor = test[0];
            var destination = $(anchor).offset().top - 50;
            var scroll = $(document).scrollTop();
            if (destination != scroll) {
                $('html, body').animate({scrollTop: destination + "px"}, 10);
            }
            return false;
        }
    })
</script>
</body>