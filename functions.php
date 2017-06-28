<?php

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
        } );
    return;
}

class MechanicSite extends TimberSite {

    // This function applies some fundamental WordPress setup, as well as our functions to include custom post types and taxonomies.
    function __construct() {
        add_theme_support( 'post-formats' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'menus' );

        // Roots.io Soil plugin
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-js-to-footer');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');

        add_filter( 'timber_context', array( $this, 'add_to_context' ) );
        add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
        add_action( 'init', array( $this, 'register_post_types' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ) );
        add_action( 'init', array( $this, 'register_menus' ) );
        add_action( 'init', array( $this, 'register_widgets' ) );
        add_action( 'init', array( $this, 'register_helpers' ) );

        parent::__construct();
    }

    function register_post_types(){
        require('lib/custom-types.php');
    }

    function register_taxonomies(){
        require('lib/taxonomies.php');
    }

    function register_menus(){
        require('lib/menus.php');
    }

    function register_widgets(){
        require('lib/widgets.php');
    }

    function register_helpers(){
        require('lib/helpers.php');
    }


    // Access data site-wide.

    // This function adds data to the global context of your site. In less-jargon-y terms, any values in this function are available on any view of your website. Anything that occurs on every page should be added here.

    function add_to_context( $context ) {

        // Our menu occurs on every page, so we add it to the global context.
        $context['menu'] = new TimberMenu();
        // Enable to add ACF options page fields to the global context
        // $context['options'] = get_fields('option');

        // This 'site' context below allows you to access main site information like the site title or description.
        $context['site'] = $this;
        return $context;
    }

    // Here you can add your own fuctions to Twig. Don't worry about this section if you don't come across a need for it.
    // See more here: http://twig.sensiolabs.org/doc/advanced.html
    function add_to_twig( $twig ) {
        $twig->addExtension( new Twig_Extension_StringLoader() );
        
        // Loads contents of an SVG file inline
        // Warning: file_get_contents may not work in all environments. Consider rewriting to use a CURL request instead
        $twig->addFunction( new Twig_SimpleFunction( 'svg', function( $path ) {
            if (substr($path, 0, 1) !== '/') {
                $path = "/{$path}";
            }
            echo file_get_contents(get_template_directory_uri() . $path);
        }));

        // Example of a custom Twig filter
        $twig->addFilter( new Twig_SimpleFilter('break_space', function( $text ) {
            return str_replace(' ', '<br>', $text);
        }));

        return $twig;
    }

}

new MechanicSite();


/*
 *
 * My Functions (not from Timber)
 *
 */

// Enqueue scripts
function my_scripts() {

    // Remove jQuery
    wp_deregister_script('jquery');

    // Enqueue our css and js
    // Uses the version() function in lib/helpers.php to pull from the versioned files created by Laravel Mix
    wp_enqueue_style( 'my-styles', version('css/app.css', 'assets'), false);
    wp_enqueue_script( 'my-js', version('js/app.js', 'assets'), array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );

/**
 * ACF Pro Settings
 * @link https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 */
add_filter('acf/settings/path', function ($path) {
    $path = get_stylesheet_directory() . '/acf/';
    return $path;
});

add_filter('acf/settings/dir', function ($dir) {
    $dir = get_stylesheet_directory_uri() . '/acf/';
    return $dir;
});

include_once( get_stylesheet_directory() . '/acf/acf.php' );

add_filter('acf/options_page/settings', function ($dir) {
    $dir = get_stylesheet_directory_uri() . '/acf/';
    return $dir;
});


// Add ACF Options page
/*
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' => 'Global Settings',
        'menu_title' => 'Global Settings'
    ));
}
*/

// Filter to customize the value shown on Post Object types for custom posts that don't support a title
// @link https://www.advancedcustomfields.com/resources/acf-fields-post_object-result/
/*
function posttype_post_object_result( $title, $post, $field, $post_id ) {
    $title = get_field('first_name', $post->ID) . ' ' . get_field('last_name', $post->ID);
    return $title;
}
add_filter('acf/fields/post_object/result/name=acffieldname', 'posttype_post_object_result', 10, 4);
*/

// Boost jpeg encode quality, if needed
// add_filter( 'jpeg_quality', create_function( '', 'return 92;' ) );