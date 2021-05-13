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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
mix.
    // gentelella
    copy('resources/assets/gentelella/build/css/custom.css', 'public/gentellela/custom.css').
copy('resources/assets/gentelella/build/js/custom.js', 'public/gentellela/custom.js').
copy('resources/assets/gentelella/vendors/fullcalendar/dist/fullcalendar.min.css',
    'public/gentellela/vendors/fullcalendar/dist/fullcalendar.min.css').
copy('resources/assets/gentelella/vendors/fullcalendar/dist/fullcalendar.print.css',
    'public/gentellela/vendors/fullcalendar/dist/fullcalendar.print.css').
copy('resources/assets/gentelella/vendors/switchery/dist/switchery.min.js',
    'public/gentellela/vendors/switchery/dist/switchery.min.js').
copy('resources/assets/gentelella/vendors/switchery/dist/switchery.min.css',
    'public/gentellela/vendors/switchery/dist/switchery.min.css').
copy('resources/assets/gentelella//vendors/nprogress/nprogress.js',
    'public/gentellela/vendors/nprogress/nprogress.js').
copy('resources/assets/gentelella/vendors/jquery.tagsinput/dist/jquery.tagsinput.min.css',
    'public/gentellela/jquery.tagsinput.min.css').
copy('resources/assets/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js',
    'public/gentellela/jquery.tagsinput.js').
copy('resources/assets/gentelella/vendors/fullcalendar/dist/fullcalendar.min.js',
    'public/gentellela/fullcalendar.js').
copy('resources/assets/gentelella/vendors/fullcalendar/dist/lang/cs.js',
    'public/gentellela/fullcalendar-locale.js');

mix.
    // sortable
    copy('resources/js/jquery-sortable.js', 'public/js/jquery-sortable.js');
