let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/custom/create-project.js', 'public/js')
   .js('resources/assets/js/bootstrap-datetimepicker.js', 'public/js')
   .js('resources/assets/js/sb-admin.js', 'public/js')
   .js('resources/assets/js/select2.full.min.js', 'public/js')
   .js('resources/assets/js/select2.min.js', 'public/js')
   .js('resources/assets/js/i18n/es.js', 'public/js/i18n')
   .js('resources/assets/js/i18n/en.js', 'public/js/i18n')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles('resources/assets/css/sb-admin.css', 'public/css/sb-admin.css')
   .styles('resources/assets/css/login.css', 'public/css/login.css')
   .styles('resources/assets/css/custom.css', 'public/css/custom.css')
   .styles('resources/assets/css/bootstrap-datetimepicker.css', 'public/css/bootstrap-datetimepicker.css')
   .styles('resources/assets/css/select2.min.css', 'public/css/select2.min.css');
