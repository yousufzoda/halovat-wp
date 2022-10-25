<?php


class Initializer {
	public static function setup() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
	}

	public static function startSession(  ) {
		$sessionId = session_id();
		if(empty($sessionId)){
			session_start();
		}
	}


}