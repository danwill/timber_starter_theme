<?php

namespace Mechanic\Config;


class ACFSettings
{
    public static function register()
    {

        // add_action('acf/input/admin_enqueue_scripts', [get_called_class(), 'configureAdminScripts']);

        add_filter('acf/fields/wysiwyg/toolbars', [get_called_class(), 'configureEditor']);

        self::addOptionsPage();
        self::configureFields();

        /**
         * ACF Pro Settings - DON'T EDIT
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

        include_once(get_stylesheet_directory() . '/acf/acf.php');

        add_filter('acf/options_page/settings', function ($dir) {
            $dir = get_stylesheet_directory_uri() . '/acf/';
            return $dir;
        });
    }

    // Load in a custom JS file for ACF views
    public static function configureAdminScripts()
    {
        wp_enqueue_script('my-admin-js', get_template_directory_uri() . '/assets/js/acf-admin.js', array(), '1.0.0', true);
    }

    public static function configureEditor($toolbars)
    {
        // Uncomment to view format of $toolbars
        /*
        echo '< pre >';
            print_r($toolbars);
        echo '< /pre >';
        die;
        */

        // Add a new toolbar called "Very Simple"
        // - this toolbar has only 1 row of buttons
        $toolbars['Very Simple'] = array();
        $toolbars['Very Simple'][1] = array('bold', 'italic', 'link');

        return $toolbars;
    }

    public static function addOptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title' => 'Global Settings',
                'menu_title' => 'Global Settings'
            ));
        }
    }

    // Examples of how to modify ACF field values based on certain criteria
    public static function configureFields()
    {
        // Limits relationship field based on value of a custom field
        // add_filter('acf/fields/relationship/query/name=videos', function($args) {
        //     $args['meta_key'] = 'article_type';
        //     $args['meta_value'] = 'video';
        //     return $args;
        // }, 10, 3);

        // add_filter('acf/fields/relationship/query/name=videos', function($args, $field, $post_id) {
        //     // $post = get_posts($post_id);
        //     if(self::isTermPost($post_id)) {
        //         $args['cat'] = $term->id;
        //     }

        //     // error_log($post_id);
        //     $args['meta_key'] = 'article_type';
        //     $args['meta_value'] = 'video';
        //     return $args;
        // }, 10, 3);
        /*
        add_filter('acf/load_field/name=category_article', function($field) {
            // global $field;
            echo '<pre>';
            print_r($field);
            echo '</pre>';
            return $field;
        });
        */
        // Only shows top-level taxonomy terms for specified field names
        // https://support.advancedcustomfields.com/forums/topic/taxonomy-field-filter-to-only-show-parents/
        /*add_filter('acf/fields/taxonomy/wp_list_categories', function($args, $field) {
            if($field['_name'] == 'person_sector') {
                $args['depth'] = 1;
            }
            return $args;
        }, 10, 2);*/

        // Filter to customize the value shown on Post Object types for custom posts that don't support a title
        // @link https://www.advancedcustomfields.com/resources/acf-fields-post_object-result/
        /*
        function posttype_post_object_result( $title, $post, $field, $post_id ) {
            $title = get_field('first_name', $post->ID) . ' ' . get_field('last_name', $post->ID);
            return $title;
        }
        add_filter('acf/fields/post_object/result/name=acffieldname', 'posttype_post_object_result', 10, 4);
        */ }
}
