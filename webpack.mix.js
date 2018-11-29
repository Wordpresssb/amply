
let mix = require( 'laravel-mix' );

// Customizer
mix.sass( 'assets/scss/customize-controls.scss', 'dist/css/customize-controls.css' );
mix.js( 'assets/js/customize-controls.js', 'dist/js/customize-controls.js');

// Main css
mix.sass( 'assets/scss/main.scss', 'dist/css/main.css' );

// Infinite scroll css
mix.sass( 'inc/compatibility/css/infinite-scroll.scss', 'inc/compatibility/css/infinite-scroll.css' );

// skip-link-focus-fix.js
mix.js( 'assets/js/skip-link-focus-fix.js', 'dist/js/skip-link-focus-fix.js');

// all scripts
mix.scripts([
	
], 'dist/js/all.js');

// Views
mix.sass( 'views/header/header1/header1.scss', 'views/header/header1/header1.css' );