<?php

namespace Mechanic\Config;

use Mechanic\PostTypes\CustomPost;

/*
 *
 * Custom Post Types
 *
 * Notes:
 * * Use https://generatewp.com/post-type/ to generate custom post type properties
 * * Can remove standard post for a title by removing 'title' from ``supports`` argument array
 * ** If removing title and post is referenced elsewhere (e.g. Page Link), make sure ACFSettings is 
 *    updated to point to a different field when that PostType is referenced
 *
 * 
 */

class CustomPostTypes
{
    public static function register()
    {
        add_action('init', [get_called_class(), 'configure']);

        // add_action( 'admin_menu' , [get_called_class(), 'configMetaBoxes']);
    }

    public static function configure()
    {
        /*
        register_post_type(
            CustomPost::postType(),
            [
                'labels' => [
                    'name' => 'Custom Post',
                    'singular_name' => 'CustomPost'
                ],
                'public' => true,
                'menu_icon' => 'dashicons-groups',
                'has_archive' => false,
                'supports' => [
                    'title',
                    'revisions'
                ],
                'rewrite' => [
                    'slug' => 'team'
                ],
                'show_in_nav_menus' => true,
            ]
        );
        */ }

    // Removes custom taxonomy meta box from custom post type so we can use ACF instead
    public static function configMetaBoxes()
    {
        remove_meta_box('sectiondiv', 'article', 'side');
    }

    /**
     * Example showing how to modify the listing view for a custom post type
     *
     * Replace project with project namespace (optional) and postname with name of custom post type (required)
     *
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/manage_$post_type_posts_custom_column
     */

    /*
    function project_postname_columns($columns) {
        $columns = array(
            'cb'        => '<input type="checkbox" />',
            'title'      => 'Name',
            'logo'     => 'Logo',
            'date'      => 'Date',
        );
        return $columns;
    }

    function project_postname_custom_columns($column)
    {
        global $post;
        if($column == 'logo') {
            echo wp_get_attachment_image( get_field('logo', $post->ID), array(320,125) );
        }
    }

    add_action("manage_postname_posts_custom_column", "project_postname_custom_columns");
    add_filter("manage_postname_posts_columns", "project_postname_columns");
    */
}
