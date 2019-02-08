<?php
/**
 * Add section templates
 *
 * @package amply
 */

/**
 * Amply_Section_Templates class
 */
if ( ! class_exists( 'Amply_Section_Templates' ) ) {

	/**
	 * Amply_Section_Templates class
	 */
	class Amply_Section_Templates {

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

			add_action( 'init', array( $this, 'header_post_type' ) );

			// // phpcs:disable
			// add_action( 'init', array( $this, 'register_header_template' ) );
			// // phpcs:enable

			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_menu_page' ), 0 );
				add_action( 'admin_menu', array( $this, 'add_submenu_page' ), 1 );
			}

		}

		/**
		 * Register section templates post type
		 */
		public function header_post_type() {

			// Register the post type.
			register_post_type(
				'amply_header_cpt',
				array(
					'labels'              => array(
						'name'               => __( 'headers' ),
						'singular_name'      => __( 'header' ),
						'add_new'            => __( 'New Header' ),
						'add_new_item'       => __( 'Add New Header' ),
						'edit_item'          => __( 'Edit Header' ),
						'new_item'           => __( 'New Header' ),
						'view_item'          => __( 'View Header' ),
						'search_items'       => __( 'Search Headers' ),
						'not_found'          => __( 'No Headers Found' ),
						'not_found_in_trash' => __( 'No Headers found in Trash' ),
					),
					'menu_position'       => 30,
					'public'              => true,
					'has_archive'         => true,
					'hierarchical'        => false,
					'show_ui'             => true,
					'show_in_menu'        => false,
					'show_in_nav_menus'   => false,
					'can_export'          => true,
					'exclude_from_search' => true,
					'capability_type'     => 'post',
					'rewrite'             => false,
					'supports'            => array( 'title', 'editor', 'custom-fields', 'author', 'elementor' ),
					'show_in_rest'        => true,
				)
			);

		}

		/**
		 * Register header cpt template
		 */
		public function register_header_template() {

			$post_type_object = get_post_type_object( 'amply_header_cpt' );

			$post_type_object->template = array(
				array(
					'core/paragraph',
					array(
						'placeholder' => 'Paragraphe text…',
					),
				),
			);

		}

		/**
		 * Register a new menu page for section templates panel
		 */
		public function add_menu_page() {

			add_menu_page(
				esc_html__( 'Section Templates', 'amply' ),
				'Section Templates', // This menu cannot be translated because it's used for the $hook prefix.
				apply_filters( 'amply_section_templates_capabilities', 'manage_options' ),
				'amply-section-templates-panel',
				'',
				'dashicons-admin-generic',
				null
			);

		}

		/**
		 * Add sub menu page for header cpt
		 */
		public function add_submenu_page() {

			add_submenu_page(
				'amply-section-templates-panel',
				esc_html__( 'Headers', 'amply' ),
				esc_html__( 'Headers', 'amply' ),
				'manage_options',
				'edit.php?post_type=amply_header_cpt'
			);

		}

	}

}
Amply_Section_Templates::get_instance();
