<?php
/*
Template Name: Promotions(Blog)
*/
get_header(); ?>
<?php echo do_shortcode(get_field('intro_slider_shortcode')); ?>
    <main>
        <?php get_template_part('template-parts/page-content') ?>
        <?php $arr_query = array(
            'post_type' => 'event',
        );


        $search = new WP_Query($arr_query); ?>
        <section class="fe-blog-content">
            <div class="container blog-container">
                <?php foreach ($search->posts as $post) { ?>
                    <article class="fe-article">
                        <div class="fe-article__img" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID,'large') ?>)"></div>
                        <h4 class="fe-article__sub-title"><?php the_field('sub_title', $post->ID) ?></h4>
                        <h2 class="fe-article__title"><?php echo $post->post_title; ?></h2>
                        <span class="fe-article__date"><?php the_field('start_date', $post->ID) ?><br><?php the_field('end_date', $post->ID) ?></span>
                        <div class="fe-article__excerpt">
                            <p><?php echo $post->post_excerpt; ?></p>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </section>
    </main>
<?php get_footer();
