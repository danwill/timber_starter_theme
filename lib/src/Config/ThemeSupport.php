<?php
namespace Mechanic\Config;

class ThemeSupport
{
    public static function register()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');

        // Roots.io Soil plugin
        add_theme_support('soil-clean-up');
        add_theme_support('soil-disable-asset-versioning');
        add_theme_support('soil-disable-trackbacks');
        add_theme_support('soil-js-to-footer');
        add_theme_support('soil-nav-walker');
        add_theme_support('soil-nice-search');
        add_theme_support('soil-relative-urls');

        // Custom login image
        /*
        add_action( 'login_enqueue_scripts', function() {
            ?>
                <style type="text/css">
                    #login h1 a, .login h1 a {
                        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-mark.svg);
                        height:65px;
                        width:320px;
                        background-size: 420px 100px;
                        background-repeat: no-repeat;
                        padding-bottom: 60px;
                    }
                </style>
            <?php
        });
        */
    }
}