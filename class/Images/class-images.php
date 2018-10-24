<?php
/**
 * Images
 *
 * @package amply
 */

namespace Amply\Images;

use Amply\Images\Image_Sizes;
use Amply\Images\Lazyload\Lazyload_Images;

/**
 * Images class
 */
class Images {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	private static $instance;

	/**
	 * Getter
	 *
	 * @return Init
	 */
	public static function get_instance() {

		if ( null === static::$instance ) {
				static::$instance = new static();
		}
		return static::$instance;

	}

	/**
	 * Constructor
	 */
	private function __construct() {

		add_action( 'wp', array( $this, 'activate_lazyload_images' ) );

		Image_Sizes::get_instance();

	}

	/**
	 * Do not always activate lazyload images.
	 *
	 * @link https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/
	 *
	 * @return void
	 */
	public function activate_lazyload_images() {

		// If this is the admin page, do nothing.
		if ( is_admin() ) {
			return;
		}

		// If lazy-load is disabled in Customizer, do nothing.
		if ( 'no-lazyload' === get_theme_mod( 'lazy_load_media' ) ) {
			return;
		}

		// If the Jetpack Lazy-Images module is active, do nothing.
		if ( ! apply_filters( 'lazyload_is_enabled', true ) ) {
			return;
		}

		// If AMP is active, do nothing.
		if ( amply_is_amp() ) {
			return;
		}

		Lazyload_Images::get_instance();

	}

}
