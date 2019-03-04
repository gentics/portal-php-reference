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

let publicAssetsRoot = 'public/static/demo-assets/files';
let resourcesRoot = 'resources/assets/';

mix.options({
	processCssUrls: false,
});

mix.ts(resourcesRoot + '/js/app.ts', publicAssetsRoot + '/js')
	.sass(resourcesRoot + '/scss/styles.scss', publicAssetsRoot + '/css');

mix.copyDirectory(resourcesRoot + '/img', publicAssetsRoot + '/img');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', publicAssetsRoot + '/fonts');

// Generate source maps on development build
if (!mix.inProduction()) {
	mix.sourceMaps();
}

// Add versions on production build
if (mix.inProduction()) {
	mix.version();
}
