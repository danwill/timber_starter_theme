<?php
namespace Mechanic\Config;

class CustomTaxonomies
{
    public static function register()
    {
        // add_action('init', [get_called_class(), 'taxonomies'], 0);
    }
    public static function taxonomies()
    {
        /*
        $labels = array(
            'name'                       => 'Sectors',
            'singular_name'              => 'Sector',
            'menu_name'                  => 'Sector',
            'all_items'                  => 'All Sectors',
            'parent_item'                => 'Sector Group',
            'parent_item_colon'          => 'Sector Group:',
            'new_item_name'              => 'New Sector Name',
            'add_new_item'               => 'Add New Sector',
            'edit_item'                  => 'Edit Sector',
            'update_item'                => 'Update Sector',
            'view_item'                  => 'View Item',
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => false,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => false,
        );
        */
        // Can leave the item out of the side nav by leaving this array empty. Can attach via ACF
        register_taxonomy( 'custom_taxonomy', ['custom_post'], $args );

    }
}