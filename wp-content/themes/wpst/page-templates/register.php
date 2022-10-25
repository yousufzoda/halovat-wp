<?php 
/* Template Name: register Template */

if(is_user_logged_in()){
     echo "<script>document.location.href = 'http://halovat.tj';</script>";
 }
    
 get_header();

 ?>

<?php View::render( 'sections/navbar' ) ?>
<?php

if(isset($_POST["confirm_code"])){
    $id = $_POST['user_id'];
    $confirm_code = get_user_meta($id,'confirm_code',true);
       if(  $confirm_code== $_POST["confirm_code"]  ){
           	update_user_meta( $id, 'is_confirmed', 1 );
            echo '
            <br><br><br><br><br><br><br><br><br>
            <h1 class="display-3 text-center">shumo bo muvaffaqiyat apply shuded</h1>
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
                        <input type="hidden" value="<?= $_POST["user_id"] ?>" name="user_id">
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





global $wpdb;
if ( $_POST ) {
	$first_name      = $wpdb->_escape( $_POST['first_name'] );
	$last_name       = $wpdb->_escape( $_POST['last_name'] );
	$email           = $wpdb->_escape( $_POST['email'] );
	$password        = $wpdb->_escape( $_POST['password'] );
	$confirmPassword = $wpdb->_escape( $_POST['confpassword'] );
	$tel1            = $wpdb->_escape( $_POST['tel1'] );
	$tel2            = $wpdb->_escape( $_POST['tel2'] );
	$address         = $wpdb->_escape( $_POST['address'] );

	$errors = [];

    if ( empty( $last_name ) ) {
		$errors['last_name_empty'] = 'Пустое поле «Фамилия» не введена!';
	}
	else if ( strlen( $last_name ) < 3 ) {
		$errors['last_name_invaliid'] = ' Неправильно введена Фамилия!';
	}
	if ( empty( $first_name ) ) {
		$errors['first_name_empty'] = 'Пустое поле «Имя» не введено! ';
	}
	else if ( strlen( $first_name ) < 3 ) {
		$errors['first_name_invallid'] = 'Неправильно введено Имя!';
	}
	
	if ( ! is_email( $email ) ) {
		$errors['email_vallid'] = 'Пустое поле «адрес электронной почты» не введен!';
	}
	if ( email_exists( $email ) ) {
		$errors['email_exist'] = 'Неправильно введен адрес электронной почты!';
	}
	if ( strlen( $password ) < 5 ) {
		$errors['password_simple'] = 'Длина пароля должна быть не менее 6 символов!';
	}
	if ( strcmp( $password, $confirmPassword ) ) {
		$errors['password_match'] = 'Оба введённых пароля должны быть идентичны!';
	}

	if ( ! preg_match( "/^[+?]?(992)?([0-9]{9})$/", $tel1 ) ) {
			$errors['error_phone1'] = 'invallid phone number 1';
	}
	

	if (  empty( $address ) ) {
	    $errors['epmty_address'] = 'Пустое поле «адрес доставки» не введен!';
	}
	
	if ( strlen( $address ) < 5 ) {
		$errors['invallid_address'] = 'Неправильно введен адрес доставки!';
	}

	if ( count( $errors ) == 0 ) {
	    $confirm_code = random_int(1000,9999);
		$id = wp_create_user( $email, $password, $email );
		update_user_meta( $id, 'first_name', $first_name );
		update_user_meta( $id, 'last_name', $last_name );
		update_user_meta( $id, 'tel1', $tel1 );
		update_user_meta( $id, 'address', $address );
		update_user_meta( $id, 'confirm_code', $confirm_code );
		update_user_meta( $id, 'is_confirmed', 0 );
		$to =$email ;
        $subject = 'Поздравляем! | Halovat.tj';
        $body = "<h3> Привет, {$last_name} {$first_name} </h3> <br> Вы успешно зарегистрировались на нашем сайте <strong> halovat.tj </strong> <br> Ваш логин : <strong> {$email} </srtong> 
        <br> Ваш пароль : <strong> {$password} </strong>
        ";
        $headers = array('Content-Type: text/html; charset=UTF-8' ,'From: Halovat <info@halovat.tj>');
 
        wp_mail( $to, $subject, $body, $headers );
        
        $phone_number =$tel1;
        $config = array(
           'login' => 'halovattj',
            'hash' => '7a4f994cbc99a38463b415fc13310b89',
            'sender' => 'HalovatTJ',
            'server' => 'http://api.osonsms.com/sendsms_v1.php' 
        );
        
    	$dlm = ";";
        $txn_id = 'u'.$id; //ID сообщения в вашей базе данных, оно должно быть уникальным для каждого сообщения
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
        $res =  call_api_sms($config['server'], "GET", $params); ?>
        
<section class="section-register" style="margin-top:70px">
    <div class="container">
        <h1>Confirm User</h1>
        <form action="" method="post">
                    <label for="family" class="d-flex">Kode Portvejdeniye
                        </label>   
                <div class="input-group mb-3">
                        <input type="text" class="form-control" id="code"
                                name="confirm_code">
                        <input type="hidden" value="<?= $id ?>" name="user_id">
                  <div class="input-group-append">
                   <button type="submit" class="btn btn-success">OK</button>
                  </div>
                </div>
                    
        </form>
    </div>
</section>

        <?php
        die();
        }}?>

<section class="section-register" style="margin-top: 70px">
    <div class="container">

        <form action="" method="post">
            <h3 class="text-center default-color">Регистрация</h3>
			<?php
			if ( isset( $errors ) && count( $errors ) > 0 ) {
				echo '<div class="alert alert-danger" role="alert">';
				foreach ( $errors as $error ) {
					echo '<strong>' . $error . '</strong> <br>';
				}
				echo '</div>';
			}
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
                               placeholder="Например: Абдуазиз" name="first_name" value="<?php echo isset( $first_name ) ? $first_name : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="d-flex">Эл.почта(E-mail)
                            <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Например: aziz.m@mail.ru" name="email"
                               value="<?php echo isset( $email ) ? $email : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="Password" class="d-flex">Пароль
                            <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="password" class="form-control" id="Password" placeholder="Введите пароль"
                               name="password">
                    </div>
                    <div class="form-group">
                        <label for="confpassword" class="d-flex">Подверждения пароля
                            <small style="color: #ff0015;">*</small>
                        </label>
                        <input type="password" class="form-control" id="confpassword" name="confpassword"
                               placeholder="Повторите пароль">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tel">Мобильный телефон</label>
                        <small style="color: #ff0015;">*</small>
                        <input type="tel" class="form-control" id="tel"
                               placeholder="Например: 927777777" name="tel1"
                               value="<?php echo isset( $tel1 ) ? $tel1 : '' ?>">
                    </div>
                  <!--  <div class="form-group">
                        <label for="tel">telephone 2</label>
                        <input type="tel" class="form-control" id="tel"
                               placeholder="Enter telephone" name="tel2"
                               value="<?php echo isset( $tel2 ) ? $tel2 : '' ?>">
                    </div> -->
                    <div class="form-group">
                        <label for="address">Адрес доставки</label>
                        <small style="color: #ff0015;">*</small>
                        <textarea class="form-control" id="address"
                                  name="address"><?php echo isset( $address ) ? $address : '' ?></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5 d-block m-auto" id="registerSubmit">Отправить</button>
        </form>

    </div>
</section>


<?php get_footer(); ?>