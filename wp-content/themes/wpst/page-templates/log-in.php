<?php  /* Template Name: Login Template */

//get_header();
if($_POST){ 
    global $wpdb; 

//We shall SQL escape all inputs 
    $username = $wpdb->escape($_REQUEST['username']); 
    $password = $wpdb->escape($_REQUEST['password']); 


    $login_data = array(); 
    $login_data['user_login'] = $username; 
    $login_data['user_password'] = $password; 
    $login_data['remember'] = true; 

    $user_verify = wp_signon( $login_data, false );
    
    $userID = $user_verify->ID;
    
   // do_action( 'wp_login', $username );
    wp_clear_auth_cookie();
    wp_set_current_user($userID, $username);
    //wp_set_auth_cookie($userID, true);

    if (wp_validate_auth_cookie()==FALSE)
    {
    wp_set_auth_cookie($user_id, true, false);
    }
   if ( is_wp_error($user_verify) ) { 
        echo '<span class="mine">Неправильный логин или пароль ...</span>'; 
    } else
    { 

       // echo "<script type='text/javascript'>window.location.href='". home_url() ."'</script>"; 
       // exit(); 
       
      // echo wp_get_current_user()->user_firstname;
    }
    

}



?>