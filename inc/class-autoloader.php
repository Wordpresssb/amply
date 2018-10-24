<?php
/**
 * Autoloader
 *
 * @package amply
 */

/**
 * Class Autoloader
 */
class Autoloader {

	/**
	 * Variable
	 *
	 * @var array $args
	 */
	private $args;

	/**
	 * Undocumented function
	 *
	 * @param mixed $args comment.
	 */
	public function __construct( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'directory'            => null,
				'namespace_prefix'     => null,
				'lowercase'            => array( 'file' ), // 'file' | folders
				'underscore_to_hyphen' => array( 'file' ), // 'file' | folders
				'prepend_class'        => true,
				'classes_dir'          => '',
				'debug'                => false,
			)
		);
		$this->set_args( $args );
	}

	/**
	 * Undocumented function
	 *
	 * @param mixed $args comment.
	 * @return void
	 */
	public function set_args( $args ) {
		$this->args = $args;
	}

	/**
	 * Register autoloader
	 *
	 * @return void
	 */
	public function init() {
		spl_autoload_register( array( $this, 'autoload' ) );
	}

	/**
	 * Autoloads files of classes
	 *
	 * @param string $class comment.
	 * @return void
	 */
	public function autoload( $class ) {
		if ( $this->need_to_autoload( $class ) ) {
			$file = $this->convert_class_to_file( $class );
			if ( file_exists( $file ) ) {
				require_once $file;
			} else {
				$args = $this->get_args();
				if ( $args['debug'] ) {
					error_log( 'WP Namespace Autoloader could not load file: ' . print_r( $file, true ) );
				}
			}
		}
	}

	/**
	 * Undocumented function
	 *
	 * @param string $class comment.
	 * @return bool
	 */
	public function need_to_autoload( $class ) {
		$args      = $this->get_args();
		$namespace = $args['namespace_prefix'];

		if ( ! class_exists( $class ) ) {

			if ( false !== strpos( $class, $namespace ) ) {
				if ( ! class_exists( $class ) ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Undocumented function
	 *
	 * @param string  $class comment.
	 * @param boolean $check_loading_need comment.
	 * @return mixed
	 */
	public function convert_class_to_file( $class, $check_loading_need = false ) {
		if ( $check_loading_need ) {
			if ( ! $this->need_to_autoload( $class ) ) {
				return false;
			}
		}

		$dir                 = $this->get_dir();
		$namespace_file_path = $this->get_namespace_file_path( $class );
		$final_file          = $this->get_file_applying_wp_standards( $class );

		return $dir . $namespace_file_path . $final_file;
	}

	/**
	 * Undocumented function
	 *
	 * @return string
	 */
	private function get_dir() {
		$args = $this->get_args();
		$dir  = $this->sanitize_file_path( $args['classes_dir'] );

		// Directory containing all classes.
		$classes_dir = empty( $dir ) ? '' : rtrim( $dir, DIRECTORY_SEPARATOR ) . DIRECTORY_SEPARATOR;

		return untrailingslashit( $args['directory'] ) . DIRECTORY_SEPARATOR . $classes_dir;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $class comment.
	 * @return string
	 */
	private function get_namespace_file_path( $class ) {
		$args             = $this->get_args();
		$namespace_prefix = $args['namespace_prefix'];

		// Sanitized class and namespace prefix.
		$sanitized_class            = $this->sanitize_namespace( $class, false );
		$sanitized_namespace_prefix = $this->sanitize_namespace( $namespace_prefix, true );

		// Removes prefix from class namespace.
		$namespace_without_prefix = str_replace( $sanitized_namespace_prefix, '', $sanitized_class );

		// Gets namespace file path.
		$namespaces_without_prefix_arr = explode( '\\', $namespace_without_prefix );

		array_pop( $namespaces_without_prefix_arr );
		$namespace_file_path = implode( DIRECTORY_SEPARATOR, $namespaces_without_prefix_arr ) . DIRECTORY_SEPARATOR;

		if ( in_array( 'folders', $args['lowercase'], true ) ) {
			$namespace_file_path = strtolower( $namespace_file_path );
		}

		if ( in_array( 'folders', $args['underscore_to_hyphen'], true ) ) {
			$namespace_file_path = str_replace( array( '_', "\0" ), array( '-', '', ), $namespace_file_path );
		}

		if ( $namespace_file_path == '\\' || $namespace_file_path == '\/' ) {
			$namespace_file_path = '';
		}

		return $namespace_file_path;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $class comment.
	 * @return string
	 */
	private function get_file_applying_wp_standards( $class ) {
		$args = $this->get_args();

		// Sanitized class and namespace prefix.
		$sanitized_class = $this->sanitize_namespace( $class, false );

		// Gets namespace file path.
		$namespaces_arr = explode( '\\', $sanitized_class );

		$final_file = array_pop( $namespaces_arr );

		// Final file name.
		if ( in_array( 'file', $args['lowercase'], true ) ) {
			$final_file = strtolower( $final_file );
		}

		// Final file with underscores replaced.
		if ( in_array( 'file', $args['underscore_to_hyphen'], true ) ) {
			$final_file = str_replace( array( '_', "\0" ), array( '-', '', ), $final_file );
		}

		$final_file .= '.php';

		// Prepend class.
		if ( $args['prepend_class'] ) {
			$final_file = 'class-' . $final_file;
		}

		return $final_file;
	}

	/**
	 * Undocumented function
	 *
	 * @param string $file_path comment.
	 * @return string
	 */
	private function sanitize_file_path( $file_path ) {
		return trim( $file_path, DIRECTORY_SEPARATOR );
	}

	/**
	 * Undocumented function
	 *
	 * @param string $namespace
	 * @param boolean $add_backslash
	 * @return string
	 */
	private function sanitize_namespace( $namespace, $add_backslash = false ) {
		if ( $add_backslash ) {
			return trim( $namespace, '\\' ) . '\\';
		} else {
			return trim( $namespace, '\\' );
		}
	}

	/**
	 * Undocumented function
	 *
	 * @return mixed
	 */
	public function get_args() {
		return $this->args;
	}

}
