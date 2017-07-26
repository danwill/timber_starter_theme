const mix = require('laravel-mix');

const resources = 'source';
const public = 'assets';

mix.setPublicPath(public);
mix.browserSync({
    proxy: 'project.dev',
    files: [
        `${public}/js/*.js`,
        `${public}/css/*.css`,
        'views/**/*.twig',
        '**/*.php'
    ]
});

// mix.js(`${resources}/scripts/app.js`, `${public}/js`).sourceMaps() //to enable sourcemaps
mix.js(`${resources}/scripts/app.js`, `${public}/js`)
    .sass(`${resources}/styles/app.scss`, `${public}/css`, {
        outputStyle: mix.inProduction() ? 'compressed' : 'expanded'
    }).options({
        processCssUrls:false
    }); 

if(mix.inProduction()) {
    mix.version();
}

mix.disableNotifications();

// Enable this for packages that need aliasing
/*
mix.webpackConfig({
    resolve: {
        alias: {
            "TweenMax": 'gsap/src/uncompressed/TweenMax.js',
            "TimelineMax": 'gsap/src/uncompressed/TimelineMax.js',
            "TweenLite": 'gsap/src/uncompressed/TweenLite.js',
        },
    }
});
*/