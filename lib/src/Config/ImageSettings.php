<?php

namespace Mechanic\Config;

class ImageSettings
{
    public static function register()
    {
        add_action('after_setup_theme', [get_called_class(), 'configure']);
    }

    public static function configure()
    {

        // add_image_size('square', 992, 992, ['center', 'top']);
        // add_image_size('square-medium', 600, 600, ['center', 'top']);
        // add_image_size('thumb-landscape', 350, 9999);
        // add_image_size( 'profile-thumb-preview', 375, 270);
        // add_image_size( 'logo-preview', 9999, 150);

        // Can also update settings for default sizes:
        // update_option( 'thumbnail_size_w', 160 );
        // update_option( 'thumbnail_size_h', 160 );
        // update_option( 'thumbnail_crop', 1 );

        add_filter('jpeg_quality', function () {
            return 92;
        });
    }
}
