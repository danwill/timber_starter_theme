<?php

namespace Mechanic\Core;

use Mechanic\Core\Menu;
use Timber\Site as TimberSite;
use Timber\Helper as TimberHelper;

class Site extends TimberSite
{
    public function __construct()
    {
        add_filter('get_twig', [$this, 'addToTwig']);
        add_filter('timber_context', [$this, 'addToContext']);

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

    public function addToTwig($twig)
    {
        $twig->addExtension( new \Twig_Extension_StringLoader() );
        
        // Loads contents of an SVG file inline
        $twig->addFunction( new \Twig_SimpleFunction( 'svg', function( $path ) {
            if (substr($path, 0, 1) !== '/') {
                $path = "/{$path}";
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, get_template_directory_uri() . $path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $data = curl_exec($ch);
            curl_close($ch);
            echo $data;
        }));

        // Example of a custom Twig filter
        $twig->addFilter( new \Twig_SimpleFilter('break_space', function( $text ) {
            return str_replace(' ', '<br>', $text);
        }));

        $twig->addFilter( new \Twig_SimpleFilter('json_prop', function( $text ) {
            return htmlentities(json_encode($text, JSON_HEX_QUOT), ENT_QUOTES);
        }));

        $twig->addFilter( new \Twig_SimpleFilter('safe_email', function ($str) {
            $email   = '';
            for ( $i = 0, $len = strlen( $str ); $i < $len; $i++ ) {
                $j = rand( 0, 1);
                if ( $j == 0 ) {
                    $email .= '&#' . ord( $str[$i] ) . ';';
                } elseif ( $j == 1 ) {
                    $email .= $str[$i];
                }
            }
            return str_replace( '@', '&#64;', $email );
        }));

        return $twig;
    }
}