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

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/vendor/jquery/jquery.min.js')
    .copy('node_modules/pace-progress/pace.min.js', 'public/js/vendor/pace/pace.min.js')
    .copy('node_modules/@coreui/coreui-pro/dist/js/coreui.min.js', 'public/js/vendor/coreui-pro/coreui.min.js')
    .copy('node_modules/datatables.net/js/jquery.dataTables.js', 'public/js/vendor/datatables.net/jquery.dataTables.js')
    .copy('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js', 'public/js/vendor/datatables.net/dataTables.bootstrap4.js')
    .copy('node_modules/bootstrap-daterangepicker/daterangepicker.js', 'public/js/vendor/bootstrap-daterangepicker/daterangepicker.js')
    .copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js', 'public/js/vendor/bootstrap-datepicker/datepicker.js')
    .copy('node_modules/moment/min/moment.min.js', 'public/js/vendor/moment/moment.min.js')
    .copy('node_modules/select2/dist/js/select2.min.js', 'public/js/vendor/select2/select2.js');

mix.copy('node_modules/bootstrap-daterangepicker/daterangepicker.css', 'public/css/vendor/bootstrap-daterangepicker/daterangepicker.css')
    .copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', 'public/css/vendor/bootstrap-datepicker/datepicker.css')
    .copy('node_modules/select2/dist/css/select2.min.css', 'public/css/vendor/select2/select2.css')

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync('http://localhost:8000');
    mix.sourceMaps();
}
