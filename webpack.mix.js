const mix = require('laravel-mix');
const {scripts} = require("laravel-mix");
const {template} = require("lodash");

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

mix.js('resources/js/app.js', 'public/js')
    .vue().postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.styles([
    'resources/css/font-awesome.min.css',
    'resources/css/simple-line-icons.min.css',
    'resources/css/style.css',
],'public/css/coreui.css')
.scripts([
    'resources/js/jquery.min.js',
    'resources/js/popper.min.js',
    'resources/js/bootstrap.min.js',
    'resources/js/pace.min.js',
    'resources/js/Chart.min.js',
    'resources/js/template.js',
], 'public/js/coreui.js');
