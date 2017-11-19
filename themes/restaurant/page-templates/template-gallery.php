<?php
/*
Template Name: gallery template
*/
get_header(); ?>
    <main>
        <?php get_template_part('template-parts/page-content') ?>
        <section class="gallery-content">
            <div class="container">
                <div class="text-right">
                    <select id="restaurant-gallery" class="restaurant-gallery">
                        <option selected>Choose Restaurant</option>
                        <option value="34">SHOOK</option>
                        <option value="35">FISHERMAN’S COVE</option>
                        <option value="80">SENTIDOS GASTROBAR &amp; DINING</option>
                        <option value="36">PAK LOH CHIU CHOW</option>
                        <option value="37">LUK YU TEA HOUSE</option>
                    </select>
                </div>

                <ul class="grid-gallery effect-4" id="grid">

                    <?php $galleryRow = get_field('gallery_row');
                    $portion = array_slice($galleryRow, 0, 6);
                    ?>
                    <?php foreach ($portion as $item): ?>
                        <?php $extraClass = '';
                        $gridSizer = 'grid-sizer';
                        if ($item['size'] == 'width_large') {
                            $extraClass = 'grid-item--width2';
                            $gridSizer = '';
                        };
                        $class = $gridSizer . ' grid-gallery-item ' . $extraClass ?>
<!--                        --><?php //var_dump($item) ?>
                        <?php $caption = $item['img']['caption'] ?>
                        <li class="<?php echo $class; ?>">
                            <a href="<?php echo $item['img']['url'] ?>" title="<?php echo $caption ?>" class="swipebox">
                                <img src="<?php echo $item['img']['url']  ?>" alt="<?php echo $item['img']['alt'] ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="text-center">
                <a id="load-more" href="#" class="fe-button fe-button-gallery">load more</a>
            </div>

        </section>
    </main>
    <script>
        var id = <?php echo get_the_ID(); ?>;
        var count = <?php echo count($galleryRow) ?>
    </script>
<?php get_footer();