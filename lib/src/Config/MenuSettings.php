<?php

namespace Mechanic\Config;

class MenuSettings
{
    public static function register()
    {
        add_action('init', [get_called_class(), 'configure']);
    }

    public static function configure()
    {
        register_nav_menus([
            'main-nav' => __('Main Navigation'),
            'footer-nav' => __('Footer Navigation'),
        ]);
    }
}
