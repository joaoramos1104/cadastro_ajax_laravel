const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix
 .js('node_modules/jquery/dist/jquery.js','public/js/jquery/jquery.js')
 .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap/bootstrap.bundle.js')
 .js('node_modules/bootstrap/dist/js/bootstrap.js', 'public/js/bootstrap/bootstrap.js')
 .js('node_modules/bootstrap/dist/js/bootstrap.esm.js', 'public/js/bootstrap/bootstrap.esm.js')
 .css('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap/bootstrap.css')
 .css('node_modules/bootstrap/dist/css/bootstrap-reboot.css', 'public/css/bootstrap/bootstrap-reboot.css')
 .css('node_modules/bootstrap/dist/css/bootstrap-utilities.css', 'public/css/bootstrap/bootstrap-utilities.css')
 .css('node_modules/bootstrap/dist/css/bootstrap-grid.css', 'public/css/bootstrap/bootstrap-grid.css')
