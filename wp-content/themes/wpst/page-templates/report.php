<?php 
/* Template Name: report Template */

if(!is_user_logged_in()){
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
 }
  $user = wp_get_current_user();
     if($user->roles[0] !='administrator' && $user->user_nicename != 'administrator'){
         $wp_query->set_404();
          status_header( 404 );
          get_template_part( 404 ); exit();
     }

   
 get_header();

 ?>

<?php View::render( 'sections/navbar' ) ?>


<?php get_footer() ?>