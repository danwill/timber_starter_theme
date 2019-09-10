<?php

namespace Mechanic\Config;

class TwigSettings
{

    public static function register()
    {
        add_filter('timber/twig', [get_called_class(), 'configure']);
    }

    public static function configure($twig)
    {
        // To enable twig's dump() function, set `define( 'WP_DEBUG', true );` in wp_config.php
        // It's also recommended to install the timber-dump-extension for better formatting.
        // Run `composer require hellonico/timber-dump-extension` in theme directory.
        $twig->addExtension(new \Twig_Extension_StringLoader());

        // Loads contents of an SVG file inline
        $twig->addFunction(new \Twig_SimpleFunction('svg', function ($path) {
            if (substr($path, 0, 1) !== '/') {
                $path = "/{$path}";
            }
            $path = get_template_directory_uri() . $path;
            $ch = curl_init($path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $data = curl_exec($ch);
            if (curl_errno($ch)) {
                dump(curl_error($ch));
                echo '<img src="' . $path . '" />';
            } else {
                echo $data;
            }
            curl_close($ch);
        }));

        // Example of a custom Twig filter
        $twig->addFilter(new \Twig_SimpleFilter('no_orphan', function ($text) {
            return preg_replace('/\s+(\S+)\s*$/', '&nbsp;$1', $text);
        }));

        $twig->addFilter(new \Twig_SimpleFilter('break_space', function ($text) {
            return str_replace(' ', '<br>', $text);
        }));

        $twig->addFilter(new \Twig_SimpleFilter('json_prop', function ($text) {
            return htmlentities(json_encode($text, JSON_HEX_QUOT), ENT_QUOTES);
        }));

        $twig->addFilter(new \Twig_SimpleFilter('safe_email', function ($str) {
            $email   = '';
            for ($i = 0, $len = strlen($str); $i < $len; $i++) {
                $j = rand(0, 1);
                if ($j == 0) {
                    $email .= '&#' . ord($str[$i]) . ';';
                } elseif ($j == 1) {
                    $email .= $str[$i];
                }
            }
            return str_replace('@', '&#64;', $email);
        }));

        return $twig;
    }
}
