const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
 .scripts([
  'public/js/jquery-3.3.1.min.js',
  'public/js/bootstrap.min.js',
  'public/js/jquery.nice-select.min.js',
  'public/js/jquery-ui.min.js',
  'public/js/jquery.slicknav.js',
  'public/js/mixitup.min.js',
  'public/js/owl.carousel.min.js',
  'public/js/main.js'
 ], 'public/js/all.js');
