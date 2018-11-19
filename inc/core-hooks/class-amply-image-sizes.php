<?php
/**
 * Images configuration.
 *
 * @package amply
 */

/**
 * Amply_Image_Sizes class
 */
if ( ! class_exists( 'Amply_Image_Sizes' ) ) {

	/**
	 * Amply_Image_Sizes class
	 */
	class Amply_Image_Sizes {

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

			// Add custom image sizes attribute for content images.
			add_filter( 'wp_calculate_image_sizes', array( $this, 'content_image_sizes_attr' ), 10, 2 );

			// Filter the `sizes` value in the header image markup.
			add_filter( 'get_header_image_tag', array( $this, 'header_image_tag' ), 10, 3 );

			// Add custom image sizes attribute for post thumbnails.
			add_filter( 'wp_get_attachment_image_attributes', array( $this, 'post_thumbnail_sizes_attr' ), 10, 3 );

		}

		/**
		 * Custom image sizes filtered attribute.
		 *
		 * @param string $sizes A source size value for use in a 'sizes' attribute.
		 * @param array  $size  Image size. Accepts an array of width and height values in pixels (in that order).
		 * @return string A source size value for use in a content image 'sizes' attribute.
		 */
		public function content_image_sizes_attr( $sizes, $size ) {
			$width = $size[0];

			if ( 740 <= $width ) {
				$sizes = '100vw';
			}

			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$sizes = '(min-width: 960px) 75vw, 100vw';
			}

			return $sizes;
		}

		/**
		 * Header image filtered attributes.
		 *
		 * @param string $html   The HTML image tag markup being filtered.
		 * @param object $header The custom header object returned by 'get_custom_header()'.
		 * @param array  $attr   Array of the attributes for the image tag.
		 * @return string The filtered header image HTML.
		 */
		public function header_image_tag( $html, $header, $attr ) {
			if ( isset( $attr['sizes'] ) ) {
				$html = str_replace( $attr['sizes'], '100vw', $html );
			}
			return $html;
		}

		/**
		 * Post thumbnails filtered attributes.
		 *
		 * @param array $attr       Attributes for the image markup.
		 * @param int   $attachment Image attachment ID.
		 * @param array $size       Registered image size or flat array of height and width dimensions.
		 * @return array The filtered attributes for the image markup.
		 */
		public function post_thumbnail_sizes_attr( $attr, $attachment, $size ) {

			$attr['sizes'] = '100vw';

			if ( is_active_sidebar( 'sidebar-1' ) ) {
				$attr['sizes'] = '(min-width: 960px) 75vw, 100vw';
			}

			return $attr;
		}

	}

}
Amply_Image_sizes::get_instance();
