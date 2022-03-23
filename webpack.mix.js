/*
 * webpack.mix.js
 * Copyright (c) 2020 james@firefly-iii.org
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

let mix = require('laravel-mix');

mix.webpackConfig({
                      resolve: {
                          alias: {
                              'vue$': 'vue/dist/vue.runtime.common.js'
                          }
                      }
                  });

mix.js('resources/assets/js/app.js', 'public/v1/js');
mix.js('resources/assets/js/app_vue.js', 'public/v1/js').vue({version: 2});
mix.js('resources/assets/js/create_transaction.js', 'public/v1/js').vue({version: 2});
mix.js('resources/assets/js/edit_transaction.js', 'public/v1/js').vue({version: 2});
mix.js('resources/assets/js/profile.js', 'public/v1/js').vue({version: 2});

mix.js('resources/assets/frontpage-templates/terms.js', 'public/fpt');

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

// YBM
mix.sass('resources/assets/frontpage-templates/YBM/sass/styles.scss', 'public/fpt/YBM/css');
mix.copy('resources/assets/frontpage-templates/YBM/img/', 'public/fpt/YBM/img');
// SO
mix.sass('resources/assets/frontpage-templates/SO/sass/styles.scss', 'public/fpt/SO/css');
mix.copy('resources/assets/frontpage-templates/SO/img/', 'public/fpt/SO/img');
// BS
mix.sass('resources/assets/frontpage-templates/BS/sass/styles.scss', 'public/fpt/BS/css');
mix.copy('resources/assets/frontpage-templates/BS/img/', 'public/fpt/BS/img');
// BSU
mix.sass('resources/assets/frontpage-templates/BSU/sass/styles.scss', 'public/fpt/BSU/css');
mix.copy('resources/assets/frontpage-templates/BSU/img/', 'public/fpt/BSU/img');
// BTO
mix.sass('resources/assets/frontpage-templates/BTO/sass/styles.scss', 'public/fpt/BTO/css');
mix.copy('resources/assets/frontpage-templates/BTO/img/', 'public/fpt/BTO/img');
// YBO
mix.sass('resources/assets/frontpage-templates/YBO/sass/styles.scss', 'public/fpt/YBO/css');
mix.copy('resources/assets/frontpage-templates/YBO/img/', 'public/fpt/YBO/img');

// BAM
mix.sass('resources/assets/frontpage-templates/BAM/sass/styles.scss', 'public/fpt/BAM/css');
mix.copy('resources/assets/frontpage-templates/BAM/img/', 'public/fpt/BAM/img');
// BST
mix.sass('resources/assets/frontpage-templates/BST/sass/styles.scss', 'public/fpt/BST/css');
mix.copy('resources/assets/frontpage-templates/BST/img/', 'public/fpt/BST/img');
// BZ
mix.sass('resources/assets/frontpage-templates/BZ/sass/styles.scss', 'public/fpt/BZ/css');
// MBA
mix.sass('resources/assets/frontpage-templates/MBA/sass/styles.scss', 'public/fpt/MBA/css');
mix.copy('resources/assets/frontpage-templates/MBA/img/', 'public/fpt/MBA/img');
// SB
mix.sass('resources/assets/frontpage-templates/SB/sass/styles.scss', 'public/fpt/SB/css');
mix.copy('resources/assets/frontpage-templates/SB/img/', 'public/fpt/SB/img');
// SPO
mix.sass('resources/assets/frontpage-templates/SPO/styles.scss', 'public/fpt/SPO/css');
mix.copy('resources/assets/frontpage-templates/SPO/img/', 'public/fpt/SPO/img');
// IYB
mix.sass('resources/assets/frontpage-templates/IYB/sass/styles.scss', 'public/fpt/IYB/css');
mix.copy('resources/assets/frontpage-templates/IYB/img/', 'public/fpt/IYB/img');
// BV
mix.sass('resources/assets/frontpage-templates/BV/sass/styles.scss', 'public/fpt/BV/css');
mix.copy('resources/assets/frontpage-templates/BV/img/', 'public/fpt/BV/img');
// GB
mix.sass('resources/assets/frontpage-templates/GB/sass/styles.scss', 'public/fpt/GB/css');
mix.copy('resources/assets/frontpage-templates/GB/img/', 'public/fpt/GB/img');
// KMB
mix.sass('resources/assets/frontpage-templates/KMB/sass/styles.scss', 'public/fpt/KMB/css');
mix.copy('resources/assets/frontpage-templates/KMB/img/', 'public/fpt/KMB/img');
// MBV
mix.sass('resources/assets/frontpage-templates/MBV/sass/styles.scss', 'public/fpt/MBV/css');
mix.copy('resources/assets/frontpage-templates/MBV/img/', 'public/fpt/MBV/img');
// BPT
mix.sass('resources/assets/frontpage-templates/BPT/sass/styles.scss', 'public/fpt/BPT/css');
mix.copy('resources/assets/frontpage-templates/BPT/img/', 'public/fpt/BPT/img');
// OBN
mix.sass('resources/assets/frontpage-templates/OBN/sass/styles.scss', 'public/fpt/OBN/css');
mix.copy('resources/assets/frontpage-templates/OBN/img/', 'public/fpt/OBN/img');
// MBT
mix.sass('resources/assets/frontpage-templates/MBT/sass/styles.scss', 'public/fpt/MBT/css');
mix.copy('resources/assets/frontpage-templates/MBT/img/', 'public/fpt/MBT/img');
// BSh
mix.sass('resources/assets/frontpage-templates/BSh/sass/styles.scss', 'public/fpt/BSh/css');
mix.copy('resources/assets/frontpage-templates/BSh/img/', 'public/fpt/BSh/img');
// PB
mix.sass('resources/assets/frontpage-templates/PB/sass/styles.scss', 'public/fpt/PB/css');
mix.copy('resources/assets/frontpage-templates/PB/img/', 'public/fpt/PB/img');