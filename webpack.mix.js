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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
       .sourceMaps();
       mix.browserSync('127.0.0.1:8000');
         //  mix.browserSync('10.72.10.164:8000');

mix.webpackConfig({
    output: {
        chunkFilename: 'js/vuejs_code_split/[name].js',
    }
});

// mix.extract(
//   ['vue', 'axios', 'vuetify', 'vuelidate', 'jquery', 'lodash', 'popper.js', 'bootstrap', 'vuex']
// );
