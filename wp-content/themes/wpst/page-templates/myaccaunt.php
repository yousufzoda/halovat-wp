<?php /* Template Name: accaunt page Template */

if(is_user_logged_in()){
	$user = wp_get_current_user();
}else{
	echo '<script>window.location.href = "http://halovat.tj" </script>';
}
get_header();
?>

<section class="container">
    <h1>salaam</h1>
</section>

<?php get_footer(); ?>