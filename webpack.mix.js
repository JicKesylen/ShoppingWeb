const mix = require('laravel-mix');
const package = require('./package.json');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', `public/js/${package["version"]}/app.js`)
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .webpackConfig({
        resolve: {
            extensions: [".ts", ".js"]
        }
    });
