
let mix = require( 'laravel-mix' );

// Customizer
mix.sass( 'assets/scss/customize-controls.scss', 'dist/css/customize-controls.css' );
mix.js( 'assets/js/customize-controls.js', 'dist/js/customize-controls.js');

// Editor styles
mix.sass( 'assets/scss/editor-styles.scss', 'dist/css/editor-styles.css' );

// Editor styles additions
mix.sass( 'assets/scss/editor-styles-customizer-additions.scss', 'dist/css/editor-styles-customizer-additions.css' )
	.sourceMaps()
	.webpackConfig({
		devtool: "inline-source-map"
	});
	/* Production
	mix.sass( 'assets/scss/editor-styles-customizer-additions.scss', 'dist/css/editor-styles-customizer-additions.css' );
	*/

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
mix.sass( 'views/header/header2/header2.scss', 'views/header/header2/header2.css' );

mix.sass( 'views/index-content/classic-entries/classic-entries.scss', 'views/index-content/classic-entries/classic-entries.css' );
mix.sass( 'views/index-content/card1-entries/card1-entries.scss', 'views/index-content/card1-entries/card1-entries.css' );

mix.sass( 'views/single-content/single-entry.scss', 'views/single-content/single-entry.css' );
mix.sass( 'views/page-content/page-entry.scss', 'views/page-content/page-entry.css' );