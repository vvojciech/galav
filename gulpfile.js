var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var bootswatchPath = 'vendor/thomaspark/bootswatch';



    mix
        .copy(bootswatchPath + '/darkly', 'resources/assets/sass/darkly')
        .copy(bootstrapPath + '/fonts', 'public/fonts')
        .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')

        .sass('app.scss', './public/css/app.css')
        .version('public/css/app.css')
    ;

});
