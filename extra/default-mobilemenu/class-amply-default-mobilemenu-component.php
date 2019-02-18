<?php
/**
 * Default Mobile Menu Component
 *
 * @package amply
 */

/**
 * Amply_Default_Mobilemenu_Component class
 */
if ( ! class_exists( 'Amply_Default_Mobilemenu_Component' ) ) {

	/**
	 * Amply_Default_Mobilemenu_Component class
	 */
	class Amply_Default_Mobilemenu_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the mobilemenu type.
		 *
		 * @var string
		 */
		public $mobilemenu;

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

			$this->get_mobilemenu_type();

			switch ( $this->mobilemenu ) {

				case 'mobilemenucpt':
					add_action( 'amply_after_page', array( $this, 'mobilemenucpt_view' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'mobilemenucpt_styles' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'mobilemenucpt_scripts' ) );
					break;

				case 'mobilemenu1':
					add_action( 'amply_after_page', array( $this, 'mobilemenu1_view' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'mobilemenu1_styles' ) );
					add_action( 'wp_enqueue_scripts', array( $this, 'mobilemenu1_scripts' ) );
					break;
			}

		}

		/**
		 * Get mobilemenu type from customizer.
		 */
		public function get_mobilemenu_type() {

			$this->mobilemenu = amply_option( 'amply_default_mobilemenu_type' );

		}

		/**
		 * Add mobilemenucpt view.
		 */
		public function mobilemenucpt_view() {

			get_template_part( 'views/mobilemenu/mobilemenucpt/mobilemenucpt', 'partial' );

		}

		/**
		 * Add mobilemenu1 view.
		 */
		public function mobilemenu1_view() {

			get_template_part( 'views/mobilemenu/mobilemenu1/mobilemenu1', 'partial' );

		}

		/**
		 * Enqueue mobilemenucpt styles.
		 */
		public function mobilemenucpt_styles() {

			if ( amply_is_amp() ) {
				wp_enqueue_style( 'amply-mobilemenucpt-amp', get_theme_file_uri( 'views/mobilemenu/mobilemenucpt/css/mobilemenucpt-amp.css' ), array(), '20180514' );
			} else {
				wp_enqueue_style( 'amply-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenucpt/css/sidr.css' ), array(), '20180514' );
				wp_enqueue_style( 'amply-mobilemenucpt-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenucpt/css/mobilemenucpt-sidr.css' ), array(), '20180514' );
			}

		}

		/**
		 * Enqueue mobilemenu1 styles.
		 */
		public function mobilemenu1_styles() {

			if ( amply_is_amp() ) {
				wp_enqueue_style( 'amply-mobilemenu1-amp', get_theme_file_uri( 'views/mobilemenu/mobilemenu1/css/mobilemenu1-amp.css' ), array(), '20180514' );
			} else {
				wp_enqueue_style( 'amply-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenu1/css/sidr.css' ), array(), '20180514' );
				wp_enqueue_style( 'amply-mobilemenu1-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenu1/css/mobilemenu1-sidr.css' ), array(), '20180514' );
			}

		}

		/**
		 * Enqueue mobilemenucpt sidr scripts.
		 */
		public function mobilemenucpt_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			// Enqueue sidr script.
			wp_enqueue_script( 'amply-sidr', get_theme_file_uri( 'extra/default-mobilemenu/js/jquery.sidr.min.js' ), array( 'jquery' ), '20180514', false );
			wp_script_add_data( 'amply-sidr', 'defer', true );

			// Enqueue sidr menu script.
			wp_enqueue_script( 'amply-mobilemenucpt-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenucpt/js/mobilemenucpt-sidr.js' ), array( 'jquery' ), '20180514', false );
			wp_script_add_data( 'amply-mobilemenucpt-sidr', 'defer', true );

		}

		/**
		 * Enqueue mobilemenu1 sidr scripts.
		 */
		public function mobilemenu1_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			// Enqueue sidr script.
			wp_enqueue_script( 'amply-sidr', get_theme_file_uri( 'extra/default-mobilemenu/js/jquery.sidr.min.js' ), array( 'jquery' ), '20180514', false );
			wp_script_add_data( 'amply-sidr', 'defer', true );

			// Enqueue sidr menu script.
			wp_enqueue_script( 'amply-mobilemenu1-sidr', get_theme_file_uri( 'views/mobilemenu/mobilemenu1/js/mobilemenu1-sidr.js' ), array( 'jquery' ), '20180514', false );
			wp_script_add_data( 'amply-mobilemenu1-sidr', 'defer', true );

		}

	}

}
Amply_Default_Mobilemenu_Component::get_instance();
