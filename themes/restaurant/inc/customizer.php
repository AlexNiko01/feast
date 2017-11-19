<?php
/**
 * restaurant Theme Customizer
 *
 * @package restaurant
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function restaurant_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'restaurant_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */


function restaurant_enqueue_styles()
{
    wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDVypRItUgLC2WHqWdEu8hAeP23ZvB04NI', array(), true, true );
    wp_enqueue_script( 'eventemmiter', 'https://cdnjs.cloudflare.com/ajax/libs/EventEmitter/5.1.0/EventEmitter.min.js', array(), true, true );
    wp_enqueue_script( 'all', get_template_directory_uri() . '/scripts/all.min.js', array(), true, true );

    wp_enqueue_style('awesome', get_template_directory_uri() .'/bower_components/font-awesome/css/font-awesome.min.css', null, null);
    wp_enqueue_style('style-child', get_stylesheet_directory_uri() . '/css/custom.min.css', null, null);

    wp_localize_script('all', 'global',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );
}

add_action('wp_enqueue_scripts', 'restaurant_enqueue_styles');
