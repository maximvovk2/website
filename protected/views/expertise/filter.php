<?php if (isset($_GET['tech'])) $tech=$_GET['tech']; else $tech=''; ?>


<!--   --><?php //foreach($projects as $item) {
//        echo '<h4>'.$item['title'].'</h4>';
//        echo '<br />';
//        echo $item['description'];
//        echo '<br />';
//        echo '<img src="'.$item['url'].'" alt="img">';
//        foreach($tagsList as $tag){
//            if($tag['project_id'] == $item['id']){
//
//                echo '<a href="/expertise/projects/tag/'. $tag['title'] .'">'. $tag['title'] .'</a> ';
//            }
//        }
//        echo '<hr />';
//   }
//   ?>

<div class="pages-holder">
    <div class="page">
        <section class="main">
            <div class="m1">
                <div class="m2">
                    <ul class="breadcrumps group">
                        <li><a href="/">Home </a>&nbsp;&gt;&nbsp;</li>
                        <li><a href="/expertise">Expertise </a>&nbsp;&gt;&nbsp;</li>
                        <li><?php echo $tech; ?></li>
                    </ul>
                    <?php if (isset($modelTech->info)) echo  $modelTech->info; ?>
                    <?php if (count($projects)>0): ?>
                    <br><h2>Our Projects</h2>
<!--                        <p>--><?php //if (isset($modelTech->description)) echo $modelTech->description?><!--</p><hr>-->
                        <?php foreach($projects as $item): ?>
                        <div class="block_expertise group">
<!--                            <div class="image_holder">-->
<!--                                <img src="/images/tmp/partner1.jpg" alt="img">-->
<!--                            </div>-->
                            <div class="about">
                                <h3><?php echo $item['title']; ?></h3>
                                <p><?php echo $item['description']; ?></p>
                                <?php
                                    foreach($tagsList as $tag){
                                        if($tag['project_id'] == $item['id']){
                                            // Это правильный вариант
    //                                        echo '<a href="/expertise/projects/tag/'. $tag['title'] .'" class="name_tehnology">'. $tag['title'] .'</a> ';

                                            // Но висеть будет это, т.к. тэги еще не реализованы.
                                            echo "<div class='name_tehnology'>".$tag['title']."</div>" ;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div>
