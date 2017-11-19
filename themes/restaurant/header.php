<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package restaurant
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'restaurant' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="logo text-center">
            <?php if (get_header_image()):; ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo__link">
                <img  src="<?php echo(get_header_image()); ?>" alt="<?php bloginfo('name'); ?>" class="logo__img">
                <?php else: ?>
                    <?php bloginfo('name') ?>
                <?php endif; ?>
            </a>
        </div>

        <div class="container header-container">
            <div class="row">
                <div class="text-center">
                    <button aria-controls="bs-navbar" aria-expanded="false" class="collapsed navbar-toggle"
                            data-target="#bs-navbar" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
                    <?php wp_nav_menu(  array(
                        'theme_location'  => 'menu-1',
                        'menu'            => '',
                        'container'       => 'nav',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id'    => 'bs-navbar',
                        'menu_class'      => 'header-menu clearfix',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                    )); ?>
                </div>
            </div>

        </div>

	</header><!-- #masthead -->
