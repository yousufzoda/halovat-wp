<?php
include_once 'constant.php';
include_once 'app/Autoloader.php';

add_action( 'after_setup_theme', 'Initializer::setup' );
add_action( 'init', 'PostTypes::makeFoodPostType' );
add_action( 'init', 'PostTypes::makeSliderPostType' );
add_action( 'init', 'Initializer::startSession' );

add_action( 'add_meta_boxes', 'MetaBoxes::registerFoodPrice' );
add_action( 'save_post', 'MetaBoxes::saveFoodPrice' );
add_filter( 'manage_food_posts_columns', 'PostTypes::add_price_column' );
add_action( 'manage_food_posts_custom_column', 'PostTypes::show_price_value_col', 10, 2 );

add_action( 'add_meta_boxes', 'MetaBoxes::registerFoodTags' );
add_action( 'save_post', 'MetaBoxes::saveFoodTags' );

add_action( 'add_meta_boxes', 'MetaBoxes::registerFoodMakeup' );
add_action( 'save_post', 'MetaBoxes::saveFoodMakeup' );

add_action( 'add_meta_boxes', 'MetaBoxes::registerSliderNum' );
add_action( 'save_post', 'MetaBoxes::saveSliderNum' );
add_filter( 'manage_slider_posts_columns', 'PostTypes::add_slider_num_column' );
add_action( 'manage_slider_posts_custom_column', 'PostTypes::show_slider_num_value_col', 10, 2 );

add_action( 'add_meta_boxes', 'MetaBoxes::registerSliderUrl' );
add_action( 'save_post', 'MetaBoxes::saveSliderUrl' );

add_filter('show_admin_bar','__return_false');

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerImageRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editImageRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveResturantImage' );
add_action( 'create_resturants', 'MetaBoxes::SaveResturantImage' );

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerCategoriesRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editCategoriesRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveResturantCategories' );
add_action( 'create_resturants', 'MetaBoxes::SaveResturantCategories' );

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerBigImageRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editBigImageRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveBigResturantImage' );
add_action( 'create_resturants', 'MetaBoxes::SaveBigResturantImage' );

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerTagsRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editTagsRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveTagsResturant' );
add_action( 'create_resturants', 'MetaBoxes::SaveTagsResturant' );

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerAboutRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editAboutRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveAboutResturant' );
add_action( 'create_resturants', 'MetaBoxes::SaveAboutResturant' );

add_action( 'resturants_add_form_fields', 'MetaBoxes::registerIsTopRestaurant' );
add_action( 'resturants_edit_form_fields', 'MetaBoxes::editIsTopRestaurant' );

add_action( 'edit_resturants',   'MetaBoxes::SaveIsTopRestaurant' );
add_action( 'create_resturants', 'MetaBoxes::SaveIsTopRestaurant' );


register_rest_field( 'food', 'metadata', array(
    'get_callback' => function ( $data ) {
        return get_post_meta( $data['id'], '', '' );
    }, ));
	
register_rest_field( 'resturants', 'metadata', array(
    'get_callback' => function ( $data ) {
        return get_term_meta( $data['id'], '', '' );
    }, ));

register_rest_field( 'food', 'image', array(
	'get_callback' => function ( $data ) {
		return wp_get_attachment_url(get_post_thumbnail_id($data['id']));
	}, ));
register_rest_field( 'food', 'restaurant_name', array(
	'get_callback' => function ( $data ) {
		return get_term_by('id', $data['resturants'][0], 'resturants');
	}, ));


function call_api_sms($url, $method, $params){
    $curl = curl_init();
    $data = http_build_query ($params);
    if ($method == "GET") {
        curl_setopt ($curl, CURLOPT_URL, "$url?$data");
    }else if($method == "POST"){
        curl_setopt ($curl, CURLOPT_URL, $url);
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
    }else if($method == "PUT"){
        curl_setopt ($curl, CURLOPT_URL, $url);
        curl_setopt ($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded','Content-Length:'.strlen($data)));
        curl_setopt ($curl, CURLOPT_POSTFIELDS, $data);
    }else if ($method == "DELETE"){
        curl_setopt ($curl, CURLOPT_URL, "$url?$data");
        curl_setopt ($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    }else{
        dd("unkonwn method");
    }
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $arr = array();
    if ($err) {
        $arr['error'] = 1;
        $arr['msg'] = $err;
    } else {
        $res = json_decode($response);
        if (isset($res->error)){
            $arr['error'] = 1;
            $arr['msg'] = "Error Code: ". $res->error->code . " Message: " . $res->error->msg;
        }else{
            $arr['error'] = 0;
            $arr['msg'] = $response;
        }
    }
    return $arr;
}
