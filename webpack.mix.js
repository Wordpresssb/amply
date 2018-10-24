
let mix = require( 'laravel-mix' );

// Compile unminified assets ( npm run dev )
mix.sass( 'assets/src/css/main/main.scss', 'assets/css/main.css' );