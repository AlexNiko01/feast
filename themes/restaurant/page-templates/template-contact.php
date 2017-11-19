<?php
/*
Template Name: page with form
*/


get_header(); ?>
    <main>
        <?php get_template_part('template-parts/page-content') ?>
        <div class="container">


            <section class="contact-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-data__item">
                            <h5 class="contact-data__title">
                                Address
                            </h5>
                            <address>
                                <?php the_field('address', 'option') ?>
                            </address>
                        </div>
                        <div class="contact-data__item">
                            <h5 class="contact-data__title">
                                Telephone
                            </h5>
                            <div class="row">
                                <div class="col-md-2"><h5 class="contact-data__title--sub">Marketing</h5></div>
                                <div class="col-md-4"><a class="contact-data__tel"
                                                         href="tel:<?php the_field('marketing_tel_1') ?>">
                                        <?php the_field('marketing_tel_1') ?></a></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><h5 class="contact-data__title--sub">Office</h5></div>
                                <div class="col-md-4"><a class="contact-data__tel"
                                                         href="tel:<?php the_field('office_tel_1') ?>"> <?php the_field('office_tel_1') ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="contact-data__item">
                            <h5 class="contact-data__title">
                                Email
                            </h5>
                            <div class="row">
                                <div class="col-md-2"><h5 class="contact-data__title--sub">Marketing</h5></div>
                                <div class="col-md-4"><a class="contact-data__email"
                                                         href="tel:<?php the_field('marketing_tel_2') ?>">
                                        <?php the_field('marketing_tel_2') ?></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><h5 class="contact-data__title--sub">Office</h5></div>
                                <div class="col-md-4"><a class="contact-data__email"
                                                         href="tel:<?php the_field('office_tel_1') ?>">
                                        <?php the_field('office_tel_1') ?></a></div>
                            </div>
                        </div>

                        <a href="<?php the_field('location_button_url') ?>"
                           class="fe-button fe-button-no-bg"><?php the_field('location_button_text') ?></a>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form">
                            <?php echo do_shortcode(get_field('contact_form')) ?>
                        </div>

                    </div>
                </div>
            </section>
        </div>

    </main>


<?php get_footer();
