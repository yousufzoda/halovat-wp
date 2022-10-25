<?php get_header(); ?>

<?php View::render( 'sections/navbar' );

$page = get_post_field( 'post_name' );

switch ( $page ) {
	case 'foods_items':
		View::render( 'pages/foods' );
		break;
	case 'login1':
		View::render( 'pages/login' );
		break;
}

?>
<?php get_footer(); ?>