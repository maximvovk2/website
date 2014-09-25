<div class="vacancy-holder">
    <?php foreach ($model as $item) : ?>
        <article class="vacancy-item">
            <header>
                <h2 class="col-heading"><?php echo $item->title; ?></h2>
                <a href="/vacancies/send?id=<?php echo $item->id; ?>" class="btn-square vacancies fancybox.iframe">Oh, I'm exactly that Guy</a>
            </header>
            <p><?php echo $item->description; ?></p>
        </article>
    <?php endforeach; ?>
</div>