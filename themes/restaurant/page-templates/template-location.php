<?php
/*
Template Name: map template
*/
get_header(); ?>
    <main>
        <section class="text-center fe-location-data">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <h2 class="fe-title fe-title-scs"><?php the_title() ?></h2>
                <?php endwhile; ?>
            <?php endif; ?>

            <addres class="loc-address">
                <?php the_field('address', 'option') ?>
            </addres>
            <form action="" class="map-form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="location" class="control-label">
                            <input class="" type="text" id="location" placeholder="Your location" autocomplete="off">
                        </label>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="fe-button">show me the way</button>
                    </div>
                </div>

            </form>
        </section>
        <section>
            <?php $location = get_field('map', 'option') ?>
            <div class="acf-map">
                <div class="marker" data-lat="<?php echo $location['lat']; ?>"
                     data-lng="<?php echo $location['lng']; ?>"></div>
            </div>
        </section>

    </main>
<?php get_footer();
