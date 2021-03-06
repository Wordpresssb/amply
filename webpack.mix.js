
let mix = require( 'laravel-mix' );

// Customizer
mix.sass( 'assets/scss/customize-controls.scss', 'dist/css/customize-controls.css' );
mix.js( 'assets/js/customize-controls.js', 'dist/js/customize-controls.js');

mix.sass( 'extra/default-header/css/customize-controls.scss', 'extra/default-header/css/customize-controls.css' );

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
mix.sass( 'views/header/headercpt/headercpt.scss', 'views/header/headercpt/headercpt.css' );
mix.sass( 'views/header/header1/header1.scss', 'views/header/header1/header1.css' );
mix.sass( 'views/header/header2/header2.scss', 'views/header/header2/header2.css' );

mix.sass( 'views/banner/bannercpt/bannercpt.scss', 'views/banner/bannercpt/bannercpt.css' );
mix.sass( 'views/banner/banner1/banner1.scss', 'views/banner/banner1/banner1.css' );
mix.sass( 'views/banner/banner2/banner2.scss', 'views/banner/banner2/banner2.css' );

mix.sass( 'views/index-content/classic-entries/classic-entries.scss', 'views/index-content/classic-entries/classic-entries.css' );
mix.sass( 'views/index-content/card1-entries/card1-entries.scss', 'views/index-content/card1-entries/card1-entries.css' );

mix.sass( 'views/single-content/single-entry.scss', 'views/single-content/single-entry.css' );
mix.sass( 'views/page-content/page-entry.scss', 'views/page-content/page-entry.css' );

mix.sass( 'views/footer/footercpt/footercpt.scss', 'views/footer/footercpt/footercpt.css' );
mix.sass( 'views/footer/footer1/footer1.scss', 'views/footer/footer1/footer1.css' );
mix.sass( 'views/footer/footer2/footer2.scss', 'views/footer/footer2/footer2.css' );

mix.sass( 'views/slideout-panel/css/slideout-panel.scss', 'views/slideout-panel/css/slideout-panel.css' );

mix.sass( 'views/site/search/search-overlay/css/search-overlay.scss', 'views/site/search/search-overlay/css/search-overlay.css' );
mix.sass( 'views/site/search/search-overlay/css/search-overlay-amp.scss', 'views/site/search/search-overlay/css/search-overlay-amp.css' );