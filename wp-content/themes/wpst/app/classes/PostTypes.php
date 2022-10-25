<?php


class PostTypes {
	public static function makeFoodPostType() {
		$labels = array(
			'name'               => _x( 'Foods', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Food', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Foods', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Food', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'food', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Food', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Food', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Food', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Food', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Foods', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Foods', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Foods:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No food found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No food found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'foods' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'thumbnail' )
		);

		register_post_type( 'food', $args );
	}

	public static function makeSliderPostType() {
		$labels = array(
			'name'               => _x( 'Slider', 'post type general name', 'your-plugin-textdomain' ),
			'singular_name'      => _x( 'Slider', 'post type singular name', 'your-plugin-textdomain' ),
			'menu_name'          => _x( 'Slider', 'admin menu', 'your-plugin-textdomain' ),
			'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'your-plugin-textdomain' ),
			'add_new'            => _x( 'Add New', 'food', 'your-plugin-textdomain' ),
			'add_new_item'       => __( 'Add New Slide', 'your-plugin-textdomain' ),
			'new_item'           => __( 'New Slide', 'your-plugin-textdomain' ),
			'edit_item'          => __( 'Edit Slide', 'your-plugin-textdomain' ),
			'view_item'          => __( 'View Slide', 'your-plugin-textdomain' ),
			'all_items'          => __( 'All Slides', 'your-plugin-textdomain' ),
			'search_items'       => __( 'Search Slide', 'your-plugin-textdomain' ),
			'parent_item_colon'  => __( 'Parent Slide:', 'your-plugin-textdomain' ),
			'not_found'          => __( 'No food found.', 'your-plugin-textdomain' ),
			'not_found_in_trash' => __( 'No food found in Trash.', 'your-plugin-textdomain' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'your-plugin-textdomain' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'slider' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'thumbnail' )
		);

		register_post_type( 'slider', $args );
	}
	public static function add_price_column( $columns ) {
		$columns['food_price'] = 'Цена';
		return $columns;
	}

	public static function show_price_value_col( $column, $post_id ) {
		if ( $column == 'food_price' ) {
			echo '<strong style="font-size: 1.2rem">' .
			     number_format( get_post_meta( $post_id, 'food_price', true ),2 ) .
			     '  c. </strong>';
		}
	}

	public static function add_slider_num_column( $columns ) {
		$columns['slider_number'] = 'Number';
		return $columns;
	}

	public static function show_slider_num_value_col( $column, $post_id ) {
		if ( $column == 'slider_number' ) {
			echo '<strong style="font-size: 1.2rem">' .
			     get_post_meta( $post_id, 'slider_number', true ) .
			     ' </strong>';
		}
	}


}
