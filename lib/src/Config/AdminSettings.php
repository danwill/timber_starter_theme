<?php

namespace Mechanic\Config;

class AdminSettings
{

    public static function register()
    {
        add_action('admin_menu', [get_called_class(), 'configure']);
        // add_action( 'login_enqueue_scripts', [get_called_class(), 'configureLogin']);
        add_filter('acf/settings/show_admin', [get_called_class(), 'configureAcfMenus']);
    }

    public static function configure()
    {

        if (current_user_can('editor')) {
            // remove_menu_page('themes.php');          // Appearance
            // remove_menu_page('plugins.php');         // Plugins
            // remove_menu_page('users.php');           // Users
            // remove_menu_page('tools.php');           // Tools
            // remove_menu_page('options-general.php'); // Settings
        }
        remove_menu_page('edit-comments.php');  // Comments
        // remove_menu_page( 'edit.php' );           // Posts
    }

    // Configure who can see the ACF Menu Item. Return `false` to hide for everyone
    public static function configureAcfMenus()
    {
        return current_user_can('manage_options');
    }

    // Custom logo on the login screen
    public static function configureLogin()
    {
        ?>
        <style type="text/css">
            #login h1 a,
            .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-mark.svg);
                height: 65px;
                width: 320px;
                background-size: 420px 100px;
                background-repeat: no-repeat;
                padding-bottom: 60px;
            }
        </style>
<?php
    }
}
