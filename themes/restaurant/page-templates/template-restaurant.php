<?php
/*
Template Name: full width rows content
*/
get_header(); ?>

<?php echo do_shortcode(get_field('intro_slider_shortcode')); ?>
    <section class="fe-intro-content fe-content-scs">
        <div class="container">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="text-center">
                        <h2  class="restaurant-title"><?php the_title(); ?></h2>
                    </div>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <section class="fe-rows">
        <div class="container container-large">
            <?php $row = get_field('res_row');
            $extraClass = '';
            ?>
            <?php foreach ($row as $key => $item): ?>
                <article>
                    <?php if ($key % 2 == 0) {
                        $extraClass = '';
                    } else if ($key % 2 == 1) {
                        $extraClass = 'grid-reverse';
                    }; ?>
                    <div class="grid fe-dish <?php echo $extraClass ?>">
                        <div class="col col-48 <?php echo $item['slider'] ? 'item-slider' : '' ?>">
                        	<?php 
                        	if ($item['slider']) {
                        		 
								foreach ($item['slider'] as $slide) { ?>
									<div class="fe-dish__img" style="background-image: url('<?php echo $slide['url'] ?>')"></div>
								<?php }
								
							} else { ?>
								<div class="fe-dish__img" style="background-image: url('<?php echo $item['img'] ?>')"></div>
							<?php
							}
                        	?>
                            
                        </div>
                        <div class="col col-52 col-52--right">
                            <div class="fe-dish__wrap">
                                <h4 class="fe-title-md"><?php echo $item['title'] ?></h4>
                                <p><?php echo $item['content'] ?></p>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="text-center"><a href="<?php the_field('button_url') ?>"
                                    class="fe-button"><?php the_field('button_text') ?></a></div>
    </section>
<?php
$contactPart = get_field('show_contact_part');
if ($contactPart === true) {?>
    <section class="fe-call-back">
    <div class="fe-call-back__contact fe-call-back__item text-right">
        <img src="<?php the_field('left_pic') ?>" alt="" class="img-circle">
        <h3>Contact Us</h3>
        <a href="tel:<?php the_field('tel') ?>"><?php the_field('tel') ?></a>
    <a href="mailto:<?php the_field('email') ?>"><?php the_field('email') ?></a>
    <div class="fe-call-back__overlay"
         style="background-image: url('<?php the_field('contact_img') ?>')"></div>
    </div>
    <div class="fe-call-back__about fe-call-back__item">
        <img src="<?php the_field('rig_pic') ?>" alt="" class="img-circle">
        <h3>Visit us</h3>
        <?php the_field('schedule') ?>
        <div class="fe-call-back__overlay"
             style="background-image: url('<?php the_field('visit_img') ?>')"></div>
    </div>
    <div class="fe-call-back__or">or</div>
    </section>
<?php } ?>

<?php get_footer(); ?>
<script>
	jQuery(document).ready(function($){
		var itemSlider = $('.item-slider');
        if (itemSlider.length > 0) {
            itemSlider.slick();
        }
	})
</script>
