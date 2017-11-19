<?php
/**
 * restaurant functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package restaurant
 */

if (!function_exists('restaurant_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function restaurant_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on restaurant, use a find and replace
         * to change 'restaurant' to the name of your theme in all the template files.
         */
        load_theme_textdomain('restaurant', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'restaurant'),
            'menu-2' => esc_html__('Footer', 'restaurant'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('restaurant_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'restaurant_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function restaurant_content_width()
{
    $GLOBALS['content_width'] = apply_filters('restaurant_content_width', 640);
}

add_action('after_setup_theme', 'restaurant_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function restaurant_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'restaurant'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'restaurant'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'restaurant_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function restaurant_scripts()
{
    wp_enqueue_style('restaurant-style', get_stylesheet_uri());

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
//    wp_enqueue_style('restaurant-style-fix', get_template_directory_uri().'/css/fix.css');
}

add_action('wp_enqueue_scripts', 'restaurant_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load API Ajax callbacks
 */
require get_template_directory() . '/inc/api-integration.php';

//add_image_size( 'name', width, height, array('center','center'));
add_action('init', 'codex_slider_init');
/**
 * Register a slider post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_slider_init()
{
    $labels = array(
        'name' => _x('sliders', 'post type general name', 'your-plugin-textdomain'),
        'singular_name' => _x('slider', 'post type singular name', 'your-plugin-textdomain'),
        'menu_name' => _x('sliders', 'admin menu', 'your-plugin-textdomain'),
        'name_admin_bar' => _x('slider', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'slider', 'your-plugin-textdomain'),
        'add_new_item' => __('Add New slider', 'your-plugin-textdomain'),
        'new_item' => __('New slider', 'your-plugin-textdomain'),
        'edit_item' => __('Edit slider', 'your-plugin-textdomain'),
        'view_item' => __('View slider', 'your-plugin-textdomain'),
        'all_items' => __('All sliders', 'your-plugin-textdomain'),
        'search_items' => __('Search sliders', 'your-plugin-textdomain'),
        'parent_item_colon' => __('Parent sliders:', 'your-plugin-textdomain'),
        'not_found' => __('No sliders found.', 'your-plugin-textdomain'),
        'not_found_in_trash' => __('No sliders found in Trash.', 'your-plugin-textdomain')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'slider'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 3,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('slider', $args);
}

add_action('init', 'codex_event_init');
/**
 * Register a event post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_event_init()
{
    $labels = array(
        'name' => _x('events', 'post type general name', 'your-plugin-textdomain'),
        'singular_name' => _x('event', 'post type singular name', 'your-plugin-textdomain'),
        'menu_name' => _x('events', 'admin menu', 'your-plugin-textdomain'),
        'name_admin_bar' => _x('event', 'add new on admin bar', 'your-plugin-textdomain'),
        'add_new' => _x('Add New', 'event', 'your-plugin-textdomain'),
        'add_new_item' => __('Add New event', 'your-plugin-textdomain'),
        'new_item' => __('New event', 'your-plugin-textdomain'),
        'edit_item' => __('Edit event', 'your-plugin-textdomain'),
        'view_item' => __('View event', 'your-plugin-textdomain'),
        'all_items' => __('All events', 'your-plugin-textdomain'),
        'search_items' => __('Search events', 'your-plugin-textdomain'),
        'parent_item_colon' => __('Parent events:', 'your-plugin-textdomain'),
        'not_found' => __('No events found.', 'your-plugin-textdomain'),
        'not_found_in_trash' => __('No events found in Trash.', 'your-plugin-textdomain')
    );

    $args = array(
        'labels' => $labels,
        'description' => __('Description.', 'your-plugin-textdomain'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'event'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );

    register_post_type('event', $args);
}


if (function_exists('acf_add_options_page')) {

    $option_page = acf_add_options_page(array(
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'menu_slug' => 'theme-general-options',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

}
add_action('init', 'my_add_excerpts_to_pages');

function my_add_excerpts_to_pages()
{

    add_post_type_support('page', 'excerpt');

}

/** * @param string $file * @param mixed $args * @param string $default_folder */
function show_template($file, $args = null, $default_folder = 'template-parts')
{
    $file = $default_folder . '/' . $file . '.php';
    if ($args) {
        extract($args);
    }
    if (locate_template($file)) {
        include(locate_template($file));
    }
}

add_shortcode('custom_slider', 'sliderMarkup');
function sliderMarkup($args)
{
    $slidesPerPage = get_field('slides_per_page', $args['id']);
    if ($slidesPerPage == 1) {
        show_template('sliders/slider-intro', $args);
    }

    $relatedPagePp = get_field('related_page_on_pop_up', $args['id']);

    if ($slidesPerPage == 4 && $relatedPagePp === true) {
        show_template('sliders/slider-pop-up', $args);
    }


    if ($slidesPerPage == 4 && $relatedPagePp === false) {
        show_template('sliders/slider-non-pp', $args);
    }
}


function load_more()
{
    $iter = $_GET['iter'];
    $id = $_GET['id'];
    $restID = $_GET['restID'];
    $start = $iter * 6;
    $end = $start + 6;
    $galleryRow = get_field('gallery_row', $id);
    $galleryRowFiltered = [];

    if (!empty($restID)) {
        foreach ($galleryRow as $it) {
            $restaurantID = $it['restaurant'];
            if ($restaurantID == $restID) {
                array_push($galleryRowFiltered, $it);
            }
        }
    } else {
        $galleryRowFiltered = $galleryRow;
    }

    $portion = array_slice($galleryRowFiltered, $start, $end);
    $markup = '';
    $galleryRowFilteredFinished = false;
    if($end >= count($galleryRowFiltered)){
        $galleryRowFilteredFinished = true;
    }
    foreach ($portion as $item) {
        $extraClass = '';
        $gridSizer = 'grid-sizer';
        if ($item['size'] == 'width_large') {
            $extraClass = 'grid-item--width2';
            $gridSizer = '';
        };

        $class = $gridSizer . ' grid-gallery-item ' . $extraClass;
        $markup .= '<li class="' . $class . '"><a class="swipebox" href="' . $item['img']['url'] . '" title="'.$item['img']['caption'].'"><img src="' . $item['img']['url'] . '" alt="' . $item['img']['alt'] . '"></a></li>';

    }
    $result = [
        'markup' => $markup,
        'finished' => $galleryRowFilteredFinished
    ];
    echo json_encode($result);
    wp_die();
}

add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');

add_image_size('event-img', 1237, 820);
add_image_size('event-img-short', 1237, 300);
add_image_size('main-slider', 1192, 381);

