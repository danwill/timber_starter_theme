<?php

namespace Mechanic\Config;

class Menus
{
    /**
     * En-queue required assets
     *
     * @param  string  $action   The name of the action to hook into
     * @param  integer $priority The priority to attach the action with
     */
    public static function register($action = 'init', $priority = 10)
    {
        // Register the action
        add_action($action, function () {
            register_nav_menus([
                'main-nav' => __('Main Navigation'),
            ]);
        });

    }

    public static function removeAdminMenus() {
        add_action( 'admin_menu', function() {
            if ( current_user_can( 'editor' ) ) {
                remove_menu_page( 'themes.php' );          // Appearance
                remove_menu_page( 'plugins.php' );         // Plugins
                remove_menu_page( 'edit.php' );           // Posts
                remove_menu_page( 'users.php' );           // Users
                remove_menu_page( 'tools.php' );           // Tools
                remove_menu_page( 'edit-comments.php' );           // Tools
                remove_menu_page( 'options-general.php' ); // Settings
            }
        });
    }
}