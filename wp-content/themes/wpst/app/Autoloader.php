<?php


class Autoloader {

	public function __construct() {


		try {
			spl_autoload_register( [ $this, 'autoload' ] );
		} catch ( Exception $e ) {
			var_dump( $e );
		}
	}

	public function autoload( $className ) {
		$fileName = THEME_PATH . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . '.php';
		if ( is_file( $fileName ) && file_exists( $fileName ) && is_readable( $fileName ) ) {
			include_once $fileName;
		}
	}

}


new Autoloader();

