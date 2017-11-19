<?php
/*
Template Name: Front
*/
get_header(); ?>
<?php echo do_shortcode(get_field('intro_slider_shortcode')); ?>
    <section class="fe-intro-content">
        <div class="container">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>

    <?php $sliderDish = get_field('related_page'); ?>
    <div class="fe-menu-container container">
        <section class="fe-menu">
            <div class="mob-slider">
                <?php foreach ($sliderDish as $item): ?>
                    <div class="mob-slider__item">
                        <a href="<?php the_permalink($item->ID) ?>" class="fe-tiles">
                            <div class="fe-tile__internal">
                                <div class="fe-tile__name">
                                    <span><?php echo $item->post_title; ?></span>
                                </div>
                                <div class="fe-tile__wrapper">
                                    <div class="fe-tile__img" style="background-image: url(<?php echo get_the_post_thumbnail_url($item->ID, 'thumbnail'); ?>)">
                                        <div class="fe-tile__overlay">
                                            <span>read more</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="fe-tile__description">
                        <span>
                            <?php echo $item->post_excerpt; ?>
                        </span>
                                </div>
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>
            </div>
        </section>

    </div>
    <section class="fe-events fe-fence">
        <div class="fe-menu-container container">
            <div class="text-center">
                <h3 class="fe-title-lgh fe-title-lgh--fence">the happenings</h3>
            </div>

            <?php $eventRow = get_field('related_event');?>
            <div class="fe-events-slider">
                <?php foreach ($eventRow as $key => $item) { ?>
                    <div class="fe-events-slider__item">

                        <div href="#" class="fe-event fe-feed pop-up-active" data-toggle="modal"
                             data-target="#myModal-<?php echo $key; ?>">
                            <div class="fe-event__wrapper">
                                <div class="fe-img" style="background-image: url(<?php echo get_the_post_thumbnail_url($item->ID, 'large') ?>)">
                                    <div class="fe-img__overlay">
                                        <span>read more</span>
                                    </div>
                                </div>
                                <div class="fe-event__bot">
                                	<div class="fe-event__location">
                                        <span><strong><?php the_field('sub_title', $item->ID) ?></strong></span>
                                    </div>
                                    <div class="fe-event__name">
                                        <span><strong><?php echo $item->post_title ?></strong></span>
                                    </div>
                                    <div class="fe-event__date">
                                        <span><?php the_field('start_date', $item->ID) ?></span>
                                    </div>
                                    <div class="fe-event__time">
                                        <span><?php the_field('start_time', $item->ID) ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                <?php } ?>
            </div>

            <?php foreach ($eventRow as $key => $item) { ?>
                <div class="modal fade" id="myModal-<?php echo $key ?>" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <article class="fe-article fe-article-pp">
                                    <div class="fe-article__img"
                                         style="background-image: url(<?php echo get_the_post_thumbnail_url($item->ID, 'main-slider') ?>)"></div>
                                    <h4 class="fe-article__sub-title"><?php the_field('sub_title', $item->ID) ?></h4>
                                    <h2 class="fe-article__title"><?php echo $item->post_title; ?></h2>
                                    <span class="fe-article__date"><?php the_field('start_date', $item->ID) ?><br><?php the_field('start_time', $item->ID) ?></span>
                                    <div class="fe-article__excerpt">
                                        <p><?php echo $item->post_content; ?></p>
                                    </div>
                                </article>
                            </div>
                            <a type="button" class="close-thin" data-dismiss="modal"></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </section>
    <section class="fe-feeds fe-fence">
        <div class="container">
            <div class="text-center">
                <h3 class="fe-title-lgh fe-title-lgh--fence">news feed</h3>
            </div>
            <?php echo do_shortcode(get_field('non_pop_up_slider_shortcode')); ?>
        </div>
    </section>
<?php get_footer();

