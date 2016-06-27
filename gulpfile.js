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

    mix
    /*
     * change here to apply different bootswatch theme
     */
        //sass (is included in app.scss)
        .copy('vendor/thomaspark/bootswatch/slate', 'resources/assets/sass/bootswatch-theme')

        //css
        .copy('node_modules/fluidbox/dist/css/fluidbox.min.css', 'public/css')

        // fonts
        .copy('node_modules/bootstrap-sass/assets/fonts', 'public/fonts')

        //js
        .copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js', 'resources/assets/js')
        .copy('node_modules/isotope-layout/dist/isotope.pkgd.min.js', 'resources/assets/js')
        .copy('node_modules/imagesloaded/imagesloaded.pkgd.min.js', 'resources/assets/js')
        .copy('node_modules/fluidbox/dist/js/jquery.fluidbox.min.js', 'resources/assets/js')

        .sass('app.scss')
        .styles([
            'fluidbox.min.css',
            'app.css'
        ], 'public/css/all.css', 'public/css')
        .scripts([
            'bootstrap.min.js',
            'imagesloaded.pkgd.min.js',
            'isotope.pkgd.min.js',
            'app.js',
            'jquery.ba-throuttle-debounce.js',
            'jquery.fluidbox.min.js'
        ], 'public/js/all.js', 'resources/assets/js')
        .version(["css/all.css", "js/all.js"]);
    ;

});
