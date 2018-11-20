
let mix = require( 'laravel-mix' );

/**
 * Compile unminified assets ( npm run dev )
 */

mix.sass( 'assets/scss/admin/customizer-style.scss', 'dist/css/admin/customizer-style.css' );
mix.sass( 'assets/scss/main/main.scss', 'dist/css/main/main.css' );

mix.js( 'assets/js/skip-link-focus-fix.js', 'dist/js/skip-link-focus-fix.js');
mix.scripts([
	
], 'dist/js/all.js');