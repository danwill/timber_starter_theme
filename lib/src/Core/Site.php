<?php

namespace Mechanic\Core;

use Mechanic\Config\ACFSettings;
use Mechanic\Config\CustomPostTypes;
use Mechanic\Config\CustomTaxonomies;
use Mechanic\Config\AdminSettings;
use Mechanic\Config\MenuSettings;
use Mechanic\Config\ImageSettings;
use Mechanic\Config\TwigSettings;
use Mechanic\Config\ThemeSupport;
use Mechanic\Core\Assets;
use Mechanic\Core\Menu;
use Timber\Site as TimberSite;

class Site extends TimberSite
{
    // Run the various classes that will register with a Wordpress hook and 
    // configure our Wordpress site
    public function __construct()
    {
        // Action: after_setup_theme
        // Configures `add_theme_support` settings
        ThemeSupport::register();

        // Action: init
        // Handles `register_post_type` calls for custom post types
        CustomPostTypes::register();

        // Action: init
        // Handles `register_taxonomy` calls for custom taxonomy items
        CustomTaxonomies::register();

        // Actions: admin_menu, login_enqueue_scripts
        // Configures Wordpress admin settings (login logo, visible menu items)
        AdminSettings::register();

        // Action: init
        // Handles `register_nav_menus` for menu setup
        MenuSettings::register();

        // Actions: post_type_labels_post, manage_post_posts_columns
        // Configure labels for default Post type
        // PostSettings::register();

        // Action: after_setup_theme
        // Registers `add_image_size` calls and sets image quality
        ImageSettings::register();

        // Filters: various acf/ prefixed filters
        // Fine-tunes ACF settings, including creating Options pages
        ACFSettings::register();

        // Filter: timber/twig
        // Adds filters, functions, and extensions to the Twig engine
        TwigSettings::register();

        // Filter: wp_enqueue_scripts
        // Enqueues assets, and generates versioned urls from the site manifest
        Assets::register();

        add_filter('timber/context', [$this, 'addToContext']);

        parent::__construct();
    }

    public function addToContext($context)
    {
        $context['menu'] = new Menu('main-nav');

        // Enable to add ACF options page fields to the global context
        // $context['options'] = get_fields('option');

        $context['site'] = $this;

        return $context;
    }
}
