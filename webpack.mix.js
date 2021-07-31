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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/estilos.css', 'public/css', [
        //
    ]);

    mix.postCss('resources/css/inicio.css', 'public/css', []);
mix.postCss('resources/css/login.css', 'public/css', []);
mix.postCss('resources/css/app.css', 'public/css', []);

mix.postCss('resources/css/form.css', 'public/css', []);


mix.copyDirectory('resources/img', 'public/img');
