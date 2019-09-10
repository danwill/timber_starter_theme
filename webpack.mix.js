// Laravel Mix config
// Documentation: https://github.com/JeffreyWay/laravel-mix/tree/master/docs#readme

const mix = require('laravel-mix');

const source = 'source';
const public = 'assets';

mix.setPublicPath(public);

// Full options: https://browsersync.io/docs/options/
mix.browserSync({
    proxy: 'project.test',
    files: [
        `${public}/js/*.js`,
        `${public}/css/*.css`,
        'views/**/*.twig',
        '**/*.php'
    ],
    ghostMode: false
});

if (mix.inProduction()) {
    mix.version();
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true
                }
            }
        }
    });
}

// mix.js(`${source}/scripts/app.js`, `${public}/js`).sourceMaps() //to enable sourcemaps
mix.js(`${source}/scripts/app.js`, `${public}/js`)
    .sass(`${source}/styles/app.scss`, `${public}/css`, {
        outputStyle: mix.inProduction() ? 'compressed' : 'expanded'
    })
    .options({
        processCssUrls: false
    });



mix.disableNotifications();