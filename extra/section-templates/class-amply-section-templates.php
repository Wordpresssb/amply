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

			add_filter( 'allowed_block_types', array( $this, 'header_allowed_block_types' ), 10, 2 );

			add_action( 'init', array( $this, 'sidebar_post_type' ) );

			add_filter( 'allowed_block_types', array( $this, 'sidebar_allowed_block_types' ), 10, 2 );

			if ( is_admin() ) {
				add_action( 'admin_menu', array( $this, 'add_menu_page' ), 0 );
				add_action( 'admin_menu', array( $this, 'add_header_submenu_page' ), 1 );
				add_action( 'admin_menu', array( $this, 'add_sidebar_submenu_page' ), 1 );
			}

		}

		/**
		 * Register header post type
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
		 * Filter allowed blocks for the header cpt
		 *
		 * @param array  $allowed_block_types Array of allowed blocks.
		 * @param string $post Post.
		 */
		public function header_allowed_block_types( $allowed_block_types, $post ) {

			if ( 'amply_header_cpt' === $post->post_type ) {
				return [
					'core/audio',
					'core/button',
					'core/code',
					'core/columns',
					'core/cover-image',
					'core/embed',
					'core/file',
					'core/gallery',
					'core/image',
					'core/paragraph',
					'core/preformatted',
					'core/pullquote',
					'core/quote',
					'core/separator',
					'core/subhead',
					'core/table',
					'core/verse',

					// 'core/archives',
					// 'core/categories',
					// 'core/latest-posts',
					// 'core/latest-comments',
					// 'core/shortcode',
				];
			}

		}

		/**
		 * Register sidebar post type
		 */
		public function sidebar_post_type() {

			// Register the post type.
			register_post_type(
				'amply_sidebar_cpt',
				array(
					'labels'              => array(
						'name'               => __( 'sidebars' ),
						'singular_name'      => __( 'sidebar' ),
						'add_new'            => __( 'New Sidebar' ),
						'add_new_item'       => __( 'Add New Sidebar' ),
						'edit_item'          => __( 'Edit Sidebar' ),
						'new_item'           => __( 'New Sidebar' ),
						'view_item'          => __( 'View Sidebar' ),
						'search_items'       => __( 'Search Sidebars' ),
						'not_found'          => __( 'No Sidebars Found' ),
						'not_found_in_trash' => __( 'No Sidebars found in Trash' ),
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
		 * Filter allowed blocks for the sidebar cpt
		 *
		 * @param array  $allowed_block_types Array of allowed blocks.
		 * @param string $post Post.
		 */
		public function sidebar_allowed_block_types( $allowed_block_types, $post ) {

			if ( 'amply_sidebar_cpt' === $post->post_type ) {
				return [
					'core/audio',
					'core/button',
					'core/code',
					'core/columns',
					'core/cover-image',
					'core/embed',
					'core/file',
					'core/gallery',
					'core/image',
					'core/paragraph',
					'core/preformatted',
					'core/pullquote',
					'core/quote',
					'core/separator',
					'core/subhead',
					'core/table',
					'core/verse',

					// 'core/archives',
					// 'core/categories',
					// 'core/latest-posts',
					// 'core/latest-comments',
					// 'core/shortcode',
				];
			}

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
		public function add_header_submenu_page() {

			add_submenu_page(
				'amply-section-templates-panel',
				esc_html__( 'Headers', 'amply' ),
				esc_html__( 'Headers', 'amply' ),
				'manage_options',
				'edit.php?post_type=amply_header_cpt'
			);

		}

		/**
		 * Add sub menu page for sidebar cpt
		 */
		public function add_sidebar_submenu_page() {

			add_submenu_page(
				'amply-section-templates-panel',
				esc_html__( 'Sidebars', 'amply' ),
				esc_html__( 'Sidebars', 'amply' ),
				'manage_options',
				'edit.php?post_type=amply_sidebar_cpt'
			);

		}

	}

}
Amply_Section_Templates::get_instance();
