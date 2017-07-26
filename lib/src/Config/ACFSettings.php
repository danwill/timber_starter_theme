<?php
namespace Mechanic\Config;

/**
 * ACF Pro Settings
 * @link https://www.advancedcustomfields.com/resources/including-acf-in-a-plugin-theme/
 */
class ACFSettings
{
    public static function register()
    {
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
    }
    
    

    public static function config()
    {
        self::addOptionsPage();
        self::addFilters();
    }

    public static function addFilters()
    {
        // Only shows top-level taxonomy terms for specified field names
        // https://support.advancedcustomfields.com/forums/topic/taxonomy-field-filter-to-only-show-parents/
        add_filter('acf/fields/taxonomy/wp_list_categories', function($args, $field) {
            if($field['_name'] == 'person_sector') {
                $args['depth'] = 1;
            }
            return $args;
        }, 10, 2);
    }

    public static function addOptionsPage()
    {
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' => 'Global Settings',
                'menu_title' => 'Global Settings'
            ));
        }
    }

    
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

}