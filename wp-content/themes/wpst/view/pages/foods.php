<?php
if(isset($_POST["confirm_code"])){
    global $wpdb;
    $order = $wpdb->get_row( "SELECT * FROM wp_orders WHERE id = {$_POST['order_id']}");
       if(  $order->confirm_code== $_POST["confirm_code"]  ){
            file_get_contents("https://api.telegram.org/bot869287181:AAF_S2-vgdt51Km38iJyCqreelbDXWTnOno/sendMessage?chat_id=628020199&text=Etot_Zakaz_portvejden&reply_to_message_id={$order->message_id}");
            echo '
            <br><br><br><br><br><br><br><br><br>
            <h1 class="display-3 text-center">ZAKAZI SHUMO QABUL SHUD</h1>
            <script>
            setTimeout(() => window.location.href = "' . home_url() . '", 3000);
            </script>;
            ';
       }
       else{ ?>
       <br><br><br><br><br><br><br><br><br>
       
       <div class="container">
           <p class="alert alert-danger"> Code khato ast </p>
       <form action="" method="post">
           
                    <label for="family" class="d-flex">Kode Portvejdeniye
                        </label>   
                <div class="input-group mb-3">
                        <input type="text" class="form-control" id="code"
                                name="confirm_code">
                        <input type="hidden" value="<?= $_POST["order_id"] ?>" name="order_id">
                  <div class="input-group-append">
                   <button type="submit" class="btn btn-success">OK</button>
                  </div>
                </div>
                    
                    
       </form>
       
       </div>
       
       
       
       <?php
          
       }
        die();
}


$page       = get_post_field( 'post_name' );
$restaurant = $_GET['restaurant'];
$food_cat   = $_GET['cat'];
if ( ! term_exists( $restaurant, 'resturants' ) ) {
	echo '<script>window.location.href = "' . home_url() . '";</script>';
}

$restaurant_cats = explode( ',', trim( ( get_term_meta( get_term_by( 'slug', $restaurant, 'resturants' )
	->term_id, 'resturantCat', true ) ) ) );

$restaurant_cats_name = [];
foreach ( $restaurant_cats as $restaurant_cat ) {
	$restaurant_cats_name[ $restaurant_cat ] = get_term_by( 'slug', $restaurant_cat, 'food_category' )->name;
}

if ( ! in_array( $food_cat, $restaurant_cats ) ) {
	$food_cat = 'all';
}
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = [
	'post_type'      => 'food',
	'posts_per_page' => 15,
	'paged'          => $paged
];

if ( $food_cat === 'all' ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'resturants',
			'field'    => 'slug',
			'terms'    => $restaurant,
		),
	);
} else {
	$args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'resturants',
			'field'    => 'slug',
			'terms'    => $restaurant,
		),
		array(
			'taxonomy' => 'food_category',
			'field'    => 'slug',
			'terms'    => $food_cat,
		),
	);
}

$foods_items = new WP_Query( $args );
$image_rest = get_term_meta( get_term_by( 'slug', $restaurant, 'resturants' )->term_id, 'BigImageResturant', true ) ?get_term_meta( get_term_by( 'slug', $restaurant, 'resturants' )->term_id, 'BigImageResturant', true )  : 'http://halovat.tj/wp-content/uploads/2020/02/01.jpg';
?>


<div class="section-foods mt-5 ">
    <nav class="navbar navbar-expand-lg navbar-light nav-menu-bg m-2 m-sm-0 rounded">
        <div class="container">

            <a class="navbar-brand text-white d-block d-sm-none" href="#">Меню : </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-toggler-icon-menu text-white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link text-white" href="
                        <?= home_url() . '/' . $page . '/?restaurant=' . $restaurant ?>"> Все </a>
					<?php foreach ( $restaurant_cats_name as $slug => $name ): ?>
                        <a class="nav-item nav-link text-white" href="
                        <?= home_url() . '/' . $page . '/?restaurant=' . $restaurant . '&cat=' . $slug ?>"><?= $name ?></a>
					<?php endforeach; ?>
                </div>
            </div>
        </div>

    </nav>

    <div class="container">
        <img class="rounded img-fluid mt-2"
             src="<?= $image_rest  ?>" alt="<?= $restaurant ?>">
        <div class="row mt-3">
            <div class="col-lg-9">
				<?php
				if ( $foods_items->have_posts() ) {
					echo '<div class="row">';
					while ( $foods_items->have_posts() ) {
						$foods_items->the_post(); ?>
                        <div class="col-12 col-sm-6 col-md-4  mb-2">
                            <div class="card">
                                <img class="card-img"
                                     style="max-height: 160px; min-height: 160px"
                                     src="<?= get_the_post_thumbnail_url() ?>"
                                     alt="<?= get_the_title() ?>"
                                     title="Состав : <?php echo get_post_meta( get_the_ID(), 'food_makeup', true ) ?>"
                                     data-toggle="tooltip" data-placement="bottom"
                                >
                                <div class="card-body">
                                    <h4 class="card-title"
                                        title="Состав : <?php echo get_post_meta( get_the_ID(), 'food_makeup', true ) ?>"
                                        data-toggle="tooltip" data-placement="top"><?= get_the_title() ?></h4>
                                    <div class="buy d-flex justify-content-between align-items-center">
                                        <div class="price text-danger"><h5 class="mt-4" title="Цена">
                                                <span class="text-dark">Цена : </span>
												<?= number_format( get_post_meta( get_the_ID(), 'food_price', true ), 2 ) ?>
                                                c.
                                            </h5></div>
                                        <a href="#" class="btn btn-success mt-3 to-basket"
                                           data-restaurant="<?= $restaurant ?>"
                                           data-toggle="tooltip" data-placement="top"
                                           data-id="<?= get_the_ID(); ?>"
                                           data-price="<?= number_format( get_post_meta( get_the_ID(), 'food_price', true ), 2 ) ?>"
                                           data-title="<?= get_the_title() ?>"
                                           title="В корзину">
                                            <ion-icon name="cart"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php }
					echo '</div>';
				} else {
					echo 'not fount';
				}
				wp_reset_postdata();
				?>
            </div>


            <div class="col-lg-3"  id="shopping-cart-container">
                <div class="d-flex justify-content-between align-items-baseline px-3 d-lg-none mobile-cart-show-wrapper" id="top-mobile-cart">
                    <button class="btn btn-danger rounded-circle border-basket" id="mobile-cart-show" data-tg="0">
                        <ion-icon name="cart"></ion-icon>
                    </button>
                    <div class="align-self-center">
                        <h6 class="m-0 p-0 text-center text-white"> Блюд в корзине : <span id="foodCount"></span></h6>
                        <h6 class="m-0 p-0 text-center text-white"> На сумму : <span id="foodSum"></span> c.</h6>
                    </div>
                    <a class="btn btn-success my-2 rounded-circle  border-basket" href="tel:+992929045050">
                        <ion-icon name="call"></ion-icon>
                    </a>
                </div>
                <div class="shopping-cart-wrapper">
                    <div class="item-order border-bottom d-flex justify-content-between">
                        <h6>Корзина</h6>
                        <ion-icon class="text-danger" title="Clear" data-toggle="tooltip" id="clear-basket"
                                  name="trash"></ion-icon>
                    </div>
                        <ul class="shopping-cart list-group" id="shopping-cart"></ul>
                        
                     <h6 class="text-center text-secondary">Доставка : <strong
                                   >8.00</strong> c.</h6>
                        
                        <h6 class="text-center text-success" id="itogopar" style="display: none">Итого : <strong
                                    id="itogo"></strong> c.</h6>
                        <button class="btn btn-danger text-center w-100 mb-2" id="btn_oformit" type="button"  data-toggle="modal" data-target="#ModalZakaz"     >Оформить заказ
                        </button>
                    <div class="mt-1 border-top">
                        <h6 class="text-center text-secondary font-italic" id="restaurant_name">
							<?= get_term_by( 'slug', $restaurant, 'resturants' )->name ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

		<?php
		$page_count = $foods_items->max_num_pages;
		if ( $page_count > 1 ): ?>
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $paged == 1 ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="/<?= $page . '/page/' . ( $paged - 1 ) . '/?restaurant=' . $restaurant . '&cat=' . $food_cat ?>"
                           aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
					<?php for ( $i = 1; $i <= $page_count; $i ++ ):
						?>
                        <li class="page-item <?php
						echo $paged == $i ? ' active ' : ''; ?>">
                            <a class="page-link"
                               href="/<?= $page . '/page/' . $i . '/?restaurant=' . $restaurant . '&cat=' . $food_cat ?>"><?= $i ?></a>
                        </li>
					<?php endfor; ?>
                    <li class="page-item <?php echo $paged == $page_count ? 'disabled' : '' ?>">
                        <a class="page-link"
                           href="/<?= $page . '/page/' . ( $paged + 1 ) . '/?restaurant=' . $restaurant . '&cat=' . $food_cat ?>"
                           aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

		<?php endif;

		?>
    </div>
</div>
<div id="bg-black" class="bg-secondary"></div>


<!-- Modal -->
<div class="modal fade show" id="ModalZakaz" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Заполните форму для отправки заказа</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="form">
            <?php
            if(is_user_logged_in() ){
                $current_user = wp_get_current_user();
                $first_name = $current_user->user_firstname;
                $last_name = $current_user->user_lastname;
                $email =  $current_user->user_email;
                $tel1 = get_user_meta( $current_user->ID, 'tel1', true );
                $address = get_user_meta( $current_user->ID, 'address', true );
            }
            if ( $_POST ) {
    	        $first_name      = $wpdb->_escape( $_POST['first_name'] );
            	$last_name       = $wpdb->_escape( $_POST['last_name'] );
            	$email           = $wpdb->_escape( $_POST['email'] );
            	$tel1            = $wpdb->_escape( $_POST['tel1'] );
    	        $address         = $wpdb->_escape( $_POST['address'] );
    	        $comment         = $wpdb->_escape( $_POST['comment'] );
            	$errors = [];
        	
            	if ( empty( $first_name ) ) {
    	        	$errors['first_name_empty'] = 'Пустое поле «Имя» не введено!';
                }
                elseif ( strlen( $first_name ) < 3 ) {
    	        	$errors['first_name_invallid'] = 'Неправильно введено Имя!';
            	}
            	if ( empty( $last_name ) ) {
            		$errors['last_name_empty'] = 'Пустое поле «Фамилия» не введена!';
            	}
            	elseif ( strlen( $last_name ) < 3 ) {
            		$errors['last_name_invaliid'] = 'Неправильно введена Фамилия!';
            	}
            	
            	if(!empty($email)){
            	    if ( ! is_email( $email ) ) {
            		$errors['email_vallid'] = 'Пустое поле «адрес электронной почты» не введен!';
            	}
            	}
            	
            
                if ( empty( $tel1 ) ) {
            		$errors['tel_error'] = 'Пустое поле «номер мобильного телефона» не введен!';
            	}
                
            	if ( ! empty( $tel1 ) ) {
            		if ( ! preg_match( "/^[+?]?(992)?([0-9]{9})$/", $tel1 ) ) {
            			$errors['error_phone1'] = 'Неправильно введен номер мобильного телефона введите номер по шаблону (92) 777 77 77)!';
            		}
            	}
            
                 if ( empty( $address ) ) {
            		$errors['addres_empty'] = 'Пустое поле «адрес доставки» не введен!';
            	}
                
            	if ( ! empty( $address ) ) {
            		if ( strlen( $address ) < 5 ) {
            			$errors['invallid_address'] = 'Неправильно введен адрес доставки!';
            		}
            	}
            
    			if ( isset( $errors ) && count( $errors ) > 0 ) {
    				echo '<div class="alert alert-danger" role="alert">';
    				foreach ( $errors as $error ) {
    					
    					echo '<strong>' . $error . '</strong> <br>';
    				}
    		   		echo '</div>';
			     } else { 
			     
			     ?>
			         <h3>Ваш заказ</h3>
            <div class="table-responsive">
                <table class="table table-info table-striped table-bordered mt-3">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>

					<?php
					$jsonData =[];
					$jsonData = [
					    'rest_name' => $restaurant ,
					    'foods' => []
					];
					$i   = 0;
					$sum = 0;
					$itog = 0;
					$dostavka = 8;
					$zakaz ="%0A%0A";
					foreach ( $_POST['frm'] as $key => $value ):
						$i ++;
						$post  = get_post( $key );
						$price = get_post_meta( $key, 'food_price', true );
						$sum   += $price * $value;
						$itog = $sum + $dostavka;
						$zakaz .= "id :" .$key."%0A";
						$zakaz .= "Название : " . $post->post_title."%0A";
						$zakaz .= "Цена : ".$price." c. %0A";
						$zakaz .= "Кол-во : ".$value."%0A";
						$zakaz .= "------------------";
						
						$zakaz .="%0A";
						$jsonData['foods'][] = [
					        'food_id' => $key,
					        'food_name' => $post->post_title,
					        'food_price' => $price,
					        'food_count'=> $value
					    ];
						?>
                        <tr>
                            <td class="text-secondary"><?= $i ?>  </td>
                            <td class="font-weight-bold"><?= $post->post_title ?>  </td>
                            <td class="text-center"><?= $value ?>  </td>
                            <td><?= number_format( $price, 2 ) ?> c.</td>
                            <td class="text-danger font-weight-bold"><?= number_format( $price * $value, 2 ) ?> c.</td>
                        </tr>
					<?php endforeach;
					if(is_user_logged_in() && get_user_meta(get_current_user_id(),'is_confirmed',true) == 1){
					    $user_id = get_current_user_id();
					    $confirm_code  = null;
					    $is_confirmed = 1;
					}else{
					    $is_confirmed = 0;
					    $confirm_code = random_int(1000,9999);
					    $user_id =0;
					}
                    
                    $text = "Привет! Доброго времени суток! %0AПринят новый заказ! %0AПодтвердите заказ! %0A";
                    $text .= "Заказчик: {$first_name} {$last_name} %0AРесторан : {$restaurant} %0AЗаказ : ";
                    $text .= $zakaz;
                    $text .= "Доставка : 8 с. %0AИтого :  {$itog} сомони";
                    $text .= "%0AАдрес доставки : {$address} %0AТелефон : {$tel1} %0AЭл.почта : {$email} %0AКомментировал(а) : {$comment}";
                    if(is_user_logged_in() && get_user_meta(get_current_user_id(),'is_confirmed',true) == 1 ){
                        $text .= "%0AZAKAZ UJE CONFIRMED%0A";
					}
                    $text = preg_replace("/ /", "%20", $text);
                    $message_bot= json_decode(file_get_contents("https://api.telegram.org/bot869287181:AAF_S2-vgdt51Km38iJyCqreelbDXWTnOno/sendMessage?chat_id=628020199&text={$text}"));
                    
                    global $wpdb;
					$wpdb->insert('wp_orders', array(
                        'user_id' => $user_id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'tel' => $tel1,
                        'address'=>$address,
                        'restaurant' =>$restaurant,
                        'food' => json_encode($jsonData),
                        'comment'=>$comment,
                        'itog' => $itog,
                        'confirm_code' => $confirm_code,
                        'is_confirmed' =>$is_confirmed,
                        'message_id' => $message_bot->result->message_id
                    ));
                    
                    if(! is_user_logged_in()|| get_user_meta(get_current_user_id(),'is_confirmed',true) != 1 ){
                        $config = array(
                            'login' => 'halovattj',
                            'hash' => '7a4f994cbc99a38463b415fc13310b89',
                            'sender' => 'HalovatTJ',
                            'server' => 'http://api.osonsms.com/sendsms_v1.php' 
                        );
					    $dlm = ";";
                        $phone_number = $tel1; //номер телефона
                        $txn_id = $wpdb->insert_id; //ID сообщения в вашей базе данных, оно должно быть уникальным для каждого сообщения
                        $str_hash = hash('sha256',$txn_id.$dlm.$config['login'].$dlm.$config['sender'].$dlm.$phone_number.$dlm.$config['hash']);
                        $message = "Привет, verifikate phone {$confirm_code} ";
                        $params = array(
                            "from" => $config['sender'],
                            "phone_number" => $phone_number,
                            "msg" => $message,
                            "str_hash" => $str_hash,
                            "txn_id" => $txn_id,
                            "login"=>$config['login'],
                        );
                    $res=  call_api_sms($config['server'], "GET", $params);
                //    var_dump($res);
					}
					?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-right font-weight-bold text-danger" colspan="5">
                             <p>Доставка: 8 с.</p> 
                            <?= 'Итого к оплате: '. (number_format($sum,2)+8) . ' c.'?>
                            
                        </td>
                    </tr>
                    </tfoot>
                </table>

            </div>
            
            <div class="jumbotron">
                  <h1 class="display-4">Ваш заказ успешно принята!</h1>
                  <p class="lead"><?php echo "Уважаемый(-ая) {$last_name}! Мы отрабатываем Ваш заказ и скоро позвоним Вам, чтобы уточнить заказ! <br> Ваш адрес : <strong> {$address} </strong> <br> Ваш телефон : <strong> ${tel1} </strong>" ?></p>
                  
                  
                  <?php   if(! is_user_logged_in()  || get_user_meta(get_current_user_id(),'is_confirmed',true) != 1 ){ ?>
                      <label for="family" class="d-flex">Kode Portvejdeniye  </label>
                <div class="input-group mb-3">
                  
                   <br>
                        <input type="text" class="form-control" id="code"
                                name="confirm_code">
                        <input type="hidden" value="<?= $wpdb->insert_id ?>" name="order_id">
                  <div class="input-group-append">
                   <button type="submit" class="btn btn-success">OK</button>
                  </div>
                </div>
                    <?php } ?>
                  
                  
                  
                  
                </div>
            
			 <?php   
			 
			     }
            }
          // var_dump($_POST);
            if ( (isset( $errors ) && count( $errors ) > 0 ) || (! $_POST)) :
			?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="family" class="d-flex">Фамилия
                            <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="text" class="form-control" id="family"
                               placeholder="Например: Махкамов" name="last_name"
                               value="<?php echo isset( $last_name ) ? $last_name : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="d-flex">Имя
                            <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="text" class="form-control" id="first_name"
                               placeholder="(Например: Абдуазиз)" name="first_name" value="<?php echo isset( $first_name ) ? $first_name : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="d-flex">Электронная почта
                        </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Например: aziz.m99@mail.ru" name="email"
                               value="<?php echo isset( $email ) ? $email : '' ?>">
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tel">Телефон
                        <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="tel" class="form-control" id="tel"
                               placeholder="Например: 927777777" name="tel1"
                               value="<?php echo isset( $tel1 ) ? $tel1 : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес доставки
                        <small style="color: #ff0015;">*</small>
                        </label>
                        <textarea class="form-control" id="address"
                                 placeholder="Например: 19 мкр-36 кв-12" name="address"><?php echo isset( $address ) ? $address : '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="comment">Комментария</label>
                        <textarea class="form-control" id="comment"
                                  name="comment"><?php echo isset( $comment ) ? $comment : '' ?></textarea>
                    </div>
                </div>
            </div>
            <button class="btn btn-danger text-center w-100 mb-2" id="btn_oformit" type="submit"  >Оформить заказ</button>
            <?php endif; ?>
            <p hidden data-close="<?php if(isset($errors) && count($errors) ==0 ) echo '1' ?>" id="isHidden"></p>
        </form>
      </div>
    </div>
  </div>
</div>

