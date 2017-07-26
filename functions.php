<?php

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
        } );
    return;
}

use Timber\Timber;
// Timber::$cache = true;
Timber::$dirname = [
    'views',
    'views/partials',
];

require_once('lib/bootstrap.php');