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

 mix.disableNotifications();
 mix.browserSync({
     proxy: process.env.MIX_SENTRY_DSN_PUBLIC,
 });
 
 mix.js("resources/js/app.js", "public/js")
     .postCss("resources/css/app.css", "public/css")
     .css('resources/css/client.css', 'public/css')