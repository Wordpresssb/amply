<?php
/**
 * Init
 *
 * @package amply
 */

namespace Amply;

use Amply\Images\Images;
use Amply\Customizer\Customizer;
use Amply\CustomHeader\Custom_Header;

/**
 * Init class
 */
class Init {

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

		// Setup and core features configuration.
		Setup::get_instance();

		// Customizer.
		Customizer::get_instance();

		// General hooks.
		General_Hooks::get_instance();

		// Custom header.
		Custom_Header::get_instance();

		// Widgets.
		Widgets::get_instance();

		// Theme assets management.
		Assets::get_instance();

		// Images management.
		Images::get_instance();

	}

}
