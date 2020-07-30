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

mix.js('resources/assets/js/app.js', 'public/v1/js');

// Sedna frontpage template
mix.sass('resources/assets/frontpage-templates/sedna/sass/ie.scss', 'public/fpt/sedna/css');
mix.sass('resources/assets/frontpage-templates/sedna/sass/print.scss', 'public/fpt/sedna/css');
mix.sass('resources/assets/frontpage-templates/sedna/sass/styles.scss', 'public/fpt/sedna/css');
mix.sass('resources/assets/frontpage-templates/sedna-b1/sass/styles-b1.scss', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/bootstrap.min.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/etline-font.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/flexslider.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/ie.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/jquery.fancybox.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/normalize.min.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/print.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/css/queries.css', 'public/fpt/sedna/css');
mix.copy('resources/assets/frontpage-templates/sedna/img', 'public/fpt/sedna/img');
mix.copy('resources/assets/frontpage-templates/sedna/fonts/et-line-font/fonts/', 'public/fpt/sedna/fonts');

// Projection frontpage template
mix.copy('resources/assets/frontpage-templates/projection/', 'public/fpt/projection/');

// Baker frontpage template
mix.copy('resources/assets/frontpage-templates/baker/', 'public/fpt/baker/');

mix.js('resources/assets/frontpage-templates/sedna/js/scripts.js', 'public/fpt/sedna/js');
mix.js('resources/assets/frontpage-templates/sedna/js/jquery.flexslider-min.js', 'public/fpt/sedna/js');
mix.js('resources/assets/frontpage-templates/sedna/js/jquery.fancybox.pack.js', 'public/fpt/sedna/js');
mix.js('resources/assets/frontpage-templates/sedna/js/vendor/bootstrap.min.js', 'public/fpt/sedna/js/vendor');
mix.js('resources/assets/frontpage-templates/sedna/js/vendor/jquery-1.11.2.min.js', 'public/fpt/sedna/js/vendor');
mix.js('resources/assets/frontpage-templates/sedna/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js', 'public/fpt/sedna/js/vendor');
mix.js('resources/assets/frontpage-templates/sedna/bower_components/retina.js/dist/retina.js', 'public/fpt/sedna/bower_components/retina.js/dist/retina.js');
mix.js('resources/assets/frontpage-templates/sedna/bower_components/classie/classie.js', 'public/fpt/sedna/bower_components/classie/classie.js');
mix.js('resources/assets/frontpage-templates/sedna/bower_components/jquery-waypoints/lib/jquery.waypoints.min.js', 'public/fpt/sedna/bower_components/jquery-waypoints/lib/jquery.waypoints.min.js');

// T-1 frontpage template
mix.sass('resources/assets/frontpage-templates/t-1/styles.scss', 'public/fpt/t-1/css');
mix.copy('resources/assets/frontpage-templates/t-1/bootstrap.min.css', 'public/fpt/t-1/css');
mix.copy('resources/assets/frontpage-templates/t-1/img/background.jpg', 'public/fpt/t-1/img');
mix.copy('resources/assets/frontpage-templates/t-1/img/about_background.jpg', 'public/fpt/t-1/img');
mix.copy('resources/assets/frontpage-templates/t-1/js/bootstrap.min.js', 'public/fpt/t-1/js');
mix.copy('resources/assets/frontpage-templates/t-1/img/bm.png', 'public/fpt/t-1/img');
mix.copy('resources/assets/frontpage-templates/t-1/img/arrow.png', 'public/fpt/t-1/img');
// T-2 frontpage template
mix.sass('resources/assets/frontpage-templates/t-2/styles.scss', 'public/fpt/t-2/css');
mix.copy('resources/assets/frontpage-templates/t-2/bootstrap.min.css', 'public/fpt/t-2/css');
mix.copy('resources/assets/frontpage-templates/t-2/img/background.jpg', 'public/fpt/t-2/img');
mix.copy('resources/assets/frontpage-templates/t-2/img/background2.jpg', 'public/fpt/t-2/img');
mix.copy('resources/assets/frontpage-templates/t-2/img/about_background.jpg', 'public/fpt/t-2/img');
mix.copy('resources/assets/frontpage-templates/t-2/img/favicon.png', 'public/fpt/t-2/img');
mix.copy('resources/assets/frontpage-templates/t-2/js/bootstrap.min.js', 'public/fpt/t-2/js');
mix.copy('resources/assets/frontpage-templates/t-2/img/arrow.png', 'public/fpt/t-2/img');