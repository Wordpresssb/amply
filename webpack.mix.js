
let mix = require( 'laravel-mix' );

// Compile unminified assets ( npm run dev )
mix.sass( 'assets/src/css/main/main.scss', 'assets/css/main.css' );
mix.js( 'assets/src/js/skip-link-focus-fix.js', 'assets/js/skip-link-focus-fix.js');
mix.scripts([
	
], 'assets/js/all.js');
