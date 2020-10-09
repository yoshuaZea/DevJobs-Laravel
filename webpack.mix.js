const mix = require('laravel-mix');
require('laravel-mix-tailwind')

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

mix.react('resources/js/app.js', 'public/js')
   .autoload({
      jquery: ['$', 'window.jQuery', 'jQuery']
   })
   .js('resources/js/helpers.js', 'public/js')
   .js('resources/js/main.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .tailwind();
