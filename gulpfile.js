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
    /*
     * change here to apply different bootswatch theme
     */
        .copy(bootswatchPath + '/slate', 'resources/assets/sass/bootswatch-theme')
        .copy(bootstrapPath + '/fonts', 'public/fonts')
        .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'resources/assets/js')

        .copy('node_modules/isotope-layout/dist/isotope.pkgd.min.js', 'resources/assets/js')

        .copy('node_modules/imagesloaded/imagesloaded.pkgd.min.js', 'resources/assets/js')

        .sass('app.scss')
        .styles([
            'app.css'
        ], 'public/css/all.css', 'public/css')
        .scripts([
            'bootstrap.min.js',
            'imagesloaded.pkgd.min.js',
            'isotope.pkgd.min.js',
            'app.js'
        ], 'public/js/all.js', 'resources/assets/js')
        .version(["css/all.css", "js/all.js"]);
    ;

});
