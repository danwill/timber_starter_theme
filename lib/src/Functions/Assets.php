<?php

namespace Mechanic\Functions;

class Assets
{
    /**
     * En-queue required assets
     *
     * @param  string  $filter   The name of the filter to hook into
     * @param  integer $priority The priority to attach the filter with
     */
    public static function load($filter = 'wp_enqueue_scripts', $priority = 10)
    {
        // Register the filter
        add_filter($filter, function ($paths) {
            // Remove jQuery
            wp_deregister_script('jquery');

            // Enqueue our css and js
            // Uses the version() function to pull from the versioned files created by Laravel Mix
            wp_enqueue_style( 'my-styles', self::version('css/app.css', 'assets'), false);
            wp_enqueue_script( 'my-js', self::version('js/app.js', 'assets'), array(), false, true );
        });

        add_action('admin_enqueue_scripts', function() {
            wp_register_style( 'my-admin-styles', get_template_directory_uri() . '/assets/css/admin.css', false);
            wp_enqueue_style( 'my-admin-styles' );
        });

        
    }

    /**
     * Get the path to a versioned Mix file.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return \Illuminate\Support\HtmlString
     *
     * @throws \Exception
     */
    public static function version($path, $manifestDirectory = '')
    {
        static $manifest;
        if (substr($path, 0, 1) !== '/') {
            $path = "/{$path}";
        }
        if ($manifestDirectory && substr($manifestDirectory, 0, 1) !== '/') {
            $manifestDirectory = "/{$manifestDirectory}";
        }

        if (file_exists(get_stylesheet_directory().$manifestDirectory.'/hot')) {
            return "http://localhost:8080{$path}";
        }
        if (! $manifest) {
            if (! file_exists($manifestPath = get_stylesheet_directory().$manifestDirectory.'/mix-manifest.json')) {
                throw new \Exception('The Mix manifest does not exist.');
            }
            $manifest = json_decode(file_get_contents($manifestPath), true);
        }
        if (! array_key_exists($path, $manifest)) {
            throw new \Exception(
                "Unable to locate Mix file: {$path}. Please check your ".
                'webpack.mix.js output paths and try again.'
            );
        }
        return get_template_directory_uri().$manifestDirectory.$manifest[$path];
    }
}