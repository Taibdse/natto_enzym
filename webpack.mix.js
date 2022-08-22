let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

// mix.js('src/app.js', 'dist/').sass('src/app.scss', 'dist/');
mix.styles([
    'public/assets/lib/bootstrap/css/bootstrap.min.css',
    'public/assets/lib/font-awesome/font-awesome.min.css',
    'public/assets/lib/jqueryModal/css/jquery.modal.min.css',
    'public/assets/lib/swiper/css/swiper.min.css',
    'public/assets/lib/fancybox/css/jquery.fancybox.min.css',
    'public/assets/lib/css/system.css'

], 'public/assets/lib/css/all.css').version();

mix.scripts([
    'public/assets/lib/popper/js/popper.min.js',
    'public/assets/lib/bootstrap/js/bootstrap.min.js',
    'public/assets/lib/swiper/js/swiper.js',
    'public/assets/lib/jqueryModal/js/jquery.modal.min.js',
    'public/assets/lib/fancybox/js/jquery.fancybox.min.js',
    'public/assets/lib/js/wow.min.js',
    'public/assets/lib/jquery.matchHeight.js',
    'public/assets/lib/sweetalert28.js'

], 'public/assets/lib/js/all.js').version();

mix.browserSync('http://natto.vc/');
