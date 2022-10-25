<?php


class Assets {

	public static function __callStatic( $method, $arg ) {
		return $fileName = THEME_URL . "/assets/{$method}/{$arg[0]}";
	}

//	public static function load( $dir, $fileName ) {
//		$fileName = THEME_URL."/assets/{$dir}/{$fileName}";
//		echo $fileName;
//	}

}