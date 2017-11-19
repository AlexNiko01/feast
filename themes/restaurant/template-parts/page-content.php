<section class="fe-contact-text">
    <div class="container">
        <div class="text-center fe-content__text">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h2 class="title"><?php the_title() ?></h2>
                    <?php the_content(); ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
