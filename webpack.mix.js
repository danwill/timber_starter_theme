const mix = require('laravel-mix').mix;

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

const resources = 'source';
const public = 'assets';

mix.setPublicPath(public);
mix.browserSync({
    proxy: 'honored.dev',
    files: [
        `${public}/js/*.js`,
        `${public}/css/*.css`,
        'views/**/*.twig',
        '**/*.php'
    ]
});

// mix.js(`${resources}/scripts/app.js`, `${public}/js`).sourceMaps() //to enable sourcemaps
mix.js(`${resources}/scripts/app.js`, `${public}/js`)
   .sass(`${resources}/styles/app.scss`, `${public}/css`)
        .options({
            processCssUrls:false
        });

if(mix.config.inProduction) {
    mix.version();
}

mix.disableNotifications();
