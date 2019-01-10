<?php
/**
 * Theme color patterns.
 *
 * @package amply
 */

/**
 * Amply_Color_Patterns class
 */
if ( ! class_exists( 'Amply_Color_Patterns' ) ) {

	/**
	 * Amply_Image_Sizes class
	 */
	class Amply_Color_Patterns {

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

			add_action( 'customize_register', array( $this, 'color_options' ) );

		}

		/**
		 * Add color options.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function color_options( $wp_customize ) {

			/**
			 * Color section
			 */
			$wp_customize->add_section(
				'amply_colors_section',
				array(
					'title'    => esc_html__( 'General Styling', 'amply' ),
					'priority' => 160,
					'panel'    => 'amply_general_panel',
				)
			);

			/**
			 * Theme color.
			 */
			$wp_customize->add_setting(
				'amply_theme_color',
				array(
					'default'           => 'default',
					'transport'         => 'postMessage',
					'sanitize_callback' => 'amply_sanitize_theme_color_option',
				)
			);

			$wp_customize->add_control(
				'amply_theme_color',
				array(
					'type'     => 'radio',
					'label'    => __( 'Primary Color', 'amply' ),
					'choices'  => array(
						'default' => _x( 'Default', 'primary color', 'amply' ),
						'custom'  => _x( 'Custom', 'primary color', 'amply' ),
					),
					'section'  => 'amply_colors_section',
					'priority' => 11,
				)
			);

			// Add primary color hue setting and control.
			$wp_customize->add_setting(
				'amply_primary_color',
				array(
					'default'           => 199,
					'transport'         => 'postMessage',
					'sanitize_callback' => 'absint',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'amply_primary_color',
					array(
						'description' => __( 'Apply a custom color for buttons, links, featured images, etc.', 'amply' ),
						'section'     => 'amply_colors_section',
						'priority'    => 11,
						'mode'        => 'hue',
					)
				)
			);

		}

	}

}
Amply_Color_Patterns::get_instance();
