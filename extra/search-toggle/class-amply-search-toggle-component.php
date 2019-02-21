<?php
/**
 * Search toggle Component
 *
 * @package amply
 */

/**
 * Amply_Search_Toggle_Component class
 */
if ( ! class_exists( 'Amply_Search_Toggle_Component' ) ) {

	/**
	 * Amply_Search_Toggle_Component class
	 */
	class Amply_Search_Toggle_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the search toggle type.
		 *
		 * @var string
		 */
		public $search_toggle;

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

			$this->get_search_toggle_type();

			add_action( 'amply_search_toggle', array( $this, 'search_icon_view' ) );

			switch ( $this->search_toggle ) {

				case 'overlay1':
					add_action( 'amply_after_page', array( $this, 'search_overlay_view' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'search_overlay_styles' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'search_overlay_scripts' ) );
					break;

			}

		}

		/**
		 * Get search_toggle type from customizer.
		 */
		public function get_search_toggle_type() {

			$this->search_toggle = amply_option( 'amply_search_toggle_type' );

		}

		/**
		 * Add search icon view.
		 */
		public function search_icon_view() {

			get_template_part( 'views/site/search/search-icon' );

		}

		/**
		 * Add search icon view.
		 */
		public function search_overlay_view() {

			if ( amply_is_amp() ) {
				get_template_part( 'views/site/search/search-overlay/search-overlay-amp' );
			} else {
				get_template_part( 'views/site/search/search-overlay/search-overlay' );
			}

		}

		/**
		 * Enqueue search overlay styles.
		 */
		public function search_overlay_styles() {

			if ( amply_is_amp() ) {
				wp_enqueue_style( 'amply-search-overlay-amp', get_theme_file_uri( 'views/site/search/search-overlay/css/search-overlay-amp.css' ), array(), '20180514' );
			} else {
				wp_enqueue_style( 'amply-search-overlay', get_theme_file_uri( 'views/site/search/search-overlay/css/search-overlay.css' ), array(), '20180514' );
			}

		}

		/**
		 * Enqueue search overlay scripts.
		 */
		public function search_overlay_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			// Enqueue sidr menu script.
			wp_enqueue_script( 'amply-search-overlay', get_theme_file_uri( 'views/site/search/search-overlay/js/search-overlay.js' ), array( 'jquery', 'amply-sidr' ), '20180514', false );
			wp_script_add_data( 'amply-mobilemenucpt-sidr', 'async', true );

		}

	}

}
Amply_Search_Toggle_Component::get_instance();
