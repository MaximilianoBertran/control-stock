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

// Frontend
mix.js('resources/js/frontend/app.js', 'public/frontend/js').version().sourceMaps();
mix.sass('resources/sass/frontend/app.scss', 'public/frontend/css').version().sourceMaps();
mix.styles('public/frontend/css/custom.css', 'public/frontend/css/custom.css').version().sourceMaps();

// Backend
mix.js('resources/js/backend/app.js', 'public/backend/js').version().sourceMaps();
mix.sass('resources/sass/backend/app.scss', 'public/backend/css').version().sourceMaps();
