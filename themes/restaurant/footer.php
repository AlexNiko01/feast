<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package restaurant
 */

?>
<footer>
    <div class="fe-pre-footer">
        <div class="container">
            <div class="fe-pre-footer__content">
                <?php wp_nav_menu(  array(
                    'theme_location'  => 'menu-2',
                    'menu'            => '',
                    'container'       => 'nav',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'footer-menu clearfix',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                )); ?>
                <div class="logo fe-pre-footer__logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link">
                        <img src="<?php echo(get_header_image()); ?>" alt="logo" class="logo__img">
                    </a>
                </div>
                <?php $social = get_field('social', 'option') ?>
                <nav>
                    <ul class="social clearfix">
                        <?php foreach ($social as $item): ?>
                            <?php if (!empty($item['item']) && empty($item['img'])): ?>
                                <li class="social__item">
                                    <a href="<?php echo $item['link'] ?>" class="social__link" target="_blank">
                                        <?php echo $item['item'] ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($item['img'])): ?>
                                <li class="social__item">
                                    <a href="#" class="social__link social__link--no-bg" target="_blank">
                                        <img src="<?php echo $item['img'] ?>" alt="">
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
    </div>
    <div class="fe-footer">
        <address>
            <?php the_field('address','option') ?>
        </address>
        <a href="mailto:<?php the_field('email','option') ?>"><?php the_field('email','option') ?> </a>
        <a href="tel:<?php the_field('tel','option') ?>"><?php the_field('tel','option') ?></a>
    </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>
