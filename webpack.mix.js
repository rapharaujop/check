const mix = require('laravel-mix');

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

/*mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/

mix
    .scripts(
        [
            'node_modules/jquery/dist/jquery.min.js',
        ], 'public/site/js/node_modules/jquery.min.js')

.sass('resources/views/site/scss/style.scss', 'public/site/css/bootstrap/bootstrap.css')

.styles(
    [
        'node_modules/@fortawesome/fontawesome-free/css/all.css'
    ], 'public/site/js/node_modules/fontawesome/css/all.css')

.scripts(
    [
        'node_modules/@fortawesome/fontawesome-free/js/all.js'
    ], 'public/site/js/node_modules/fontawesome/js/all.js')

.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/site/js/node_modules/fontawesome/webfonts')

.scripts(
    [
        'node_modules/@popperjs/core/dist/cjs/popper.js'
    ], 'public/site/js/node_modules/bootstrap/popper.js')

.scripts(
    [
        'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
    ], 'public/site/js/node_modules/bootstrap/bootstrap.bundle.js')



.scripts(
    [
        'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ], 'public/site/js/node_modules/bootstrap/bootstrap.js')

.copy('node_modules/bootstrap/dist/js/bootstrap.min.js.map', 'public/site/js/node_modules/bootstrap')

.scripts(
    [
        'node_modules/jquery-mask-plugin/dist/jquery.mask.min.js'
    ], 'public/site/js/node_modules/mask/mask.js')

.scripts(
    [
        'node_modules/jquery-validation/dist/jquery.validate.min.js',
        'node_modules/jquery-validation/dist/additional-methods.min.js'
    ], 'public/site/js/node_modules/validate/validate.js')

.styles(
    [
        'resources/views/site/css/reset.css',
        'resources/views/site/css/style.css'
    ], 'public/site/css/style.css')

.scripts(
    [
        'resources/views/site/js/script.js'
    ], 'public/site/js/script.js')

.copy('resources/views/site/img', 'public/site/img')
    .version();