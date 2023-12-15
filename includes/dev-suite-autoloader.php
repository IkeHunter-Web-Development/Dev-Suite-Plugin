<?php


namespace Dev_Suite;

class Dev_Suite_Autoloader {

	private static string $default_path;

	private static string $default_namespace;

	public static function run( $default_path = '', $default_namespace = '' ) {
		if ( '' === $default_path ) {
			$default_path = DEV_SUITE_DIR;
		}

		if ( '' === $default_namespace ) {
			$default_namespace = __NAMESPACE__ . '\\';
		}

		self::$default_path      = $default_path;
		self::$default_namespace = $default_namespace;

		spl_autoload_register( array( __CLASS__, 'autoload' ) );
	}

	private static function get_file_path( $class_name ) {
		$relative_class_name = str_replace( self::$default_namespace, '', $class_name );

		$filename = strtolower( str_replace( '\\', '/', $relative_class_name ) );
		$filename = str_replace( '_', '-', $filename );

		return self::$default_path . $filename . '.php';
	}

	private static function get_includes_path( $class_name ) {
		$relative_class_name = str_replace( self::$default_namespace, '', $class_name );

		$filename = strtolower( str_replace( '\\', '/', $relative_class_name ) );

		return self::$default_path . 'includes/' . $filename . '.php';
	}

	private static function autoload( $class_name ) {
		if ( ! str_starts_with( $class_name, self::$default_namespace ) ) {
			return;
		}

		$relative_class_name = str_replace( self::$default_namespace, '', $class_name );
		$file_path           = self::get_file_path( $class_name );

		if ( ! class_exists( $class_name ) && file_exists( $file_path ) ) {
			require_once $file_path;
		} else if ( ! file_exists( $file_path ) ) {
			$file_path = self::get_includes_path( $class_name );
			if ( ! class_exists( $class_name ) && file_exists( $file_path ) ) {
				echo $file_path;
				require_once $file_path;
			}
		}


	}
}
