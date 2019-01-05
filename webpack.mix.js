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
    .sass('resources/assets/sass/app.scss', 'public/css');


mix.sass('resources/assets/sass/auth.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css');

mix.sass('resources/assets/sass/posts/index.scss', 'public/css/posts')
    .sass('resources/assets/sass/posts/show.scss', 'public/css/posts')
    .sass('resources/assets/sass/posts/form.scss', 'public/css/posts');

mix.js('resources/assets/js/posts/index.js', 'public/js/posts')
    .js('resources/assets/js/posts/show.js', 'public/js/posts')
    .js('resources/assets/js/posts/form.js', 'public/js/posts');