<?php


class View {

	public static function render( $path ) {
		get_template_part( 'view/' . $path );
	}

	public static function renderWithPassData( $view_name, $data = null ) {
		$view_path = THEME_VIEW . DIRECTORY_SEPARATOR . $view_name . '.php';
		if ( file_exists( $view_path ) ) {
			! empty( $data ) ? extract( $data ) : null;
			include $view_path;
		}
	}

}