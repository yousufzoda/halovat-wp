<?php 
/* Template Name: curier Template */

 get_header();



 ?>

<?php View::render( 'sections/navbar' ) ?>


<section class="section-slider mb-3 ">

    <div class="container">
        <div class="col-lg-12">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="http://halovat.tj/wp-content/uploads/2020/02/01.jpg" class="d-block w-100" alt="..." a href="">
      <div class="carousel-caption d-none d-md-block">
        <h5>Станьте курьером</h5>
        <p>Выбирайте заказы и зарабатывайте с нами в любое для вас удобное время.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="http://halovat.tj/wp-content/uploads/2020/02/01.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Станьте курьером</h5>
        <p>Устраивайтесь курьером в службу доставки еды Халоват.</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        </div>
    </div>
</section>


<?php


 if($_POST){
     

    
    $to = "komron.yusufjonovich@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $tel1 = $_POST['tel1'];
    $birthday = $_POST['birthday'];
    $subject = "Хочеть стать курьером";
    $subject2 = "Copy of your form submission";
    $message = "Фамилия:  " .$last_name . " Имя: " . $first_name . " Номер телефона: " .$tel1." Дата рождения: ".$birthday." " . "\n\n" . $_POST['message'];
    $message2 = "Ваш запрос принято! " . $first_name . "\n\n" . $_POST['message'];

  //  $headers = array('Content-Type: text/html; charset=UTF-8' ,'From: Halovat <info@halovat.tj>');
   
   
    $headers = "From: Halovat <info@halovat.tj>" . $from;
    $headers1 = array('Content-Type: text/html; charset=UTF-8' ,'From: Halovat <info@halovat.tj>') . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2);
    

    echo '
            
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Войти на сайт</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="https://halovat.tj/wp-login.php" method="post">
     
      <div class="modal-body">
          
          <div class="form-group">
                        <label for="exampleInputEmail1" class="d-flex">Ваш логин (email) : </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Введите эл.почта" name="log">
                    </div>
                    <div class="form-group">
                        <label for="Password" class="d-flex">Пароль : 
                        </label>
                        <input type="password" class="form-control" id="Password" placeholder="Введите пароль"
                               name="pwd">
                    </div>
                    <a href="http://halovat.tj/wp-login.php?action=lostpassword">Забыли пароль?</a>
      </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary">Войти</button>
    </div>
      
        </form>
    </div>
  </div>
</div>

            
          '; 
          
            

       
}


?>

<section class="section-register" style="margin-top: 70px">
    <div class="container">

        <form action="" method="post">
            <h3 class="text-center default-color">Стать курьером</h3>
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
                         
                        </label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               placeholder="Например: aziz.m@mail.ru" name="email"
                               value="<?php echo isset( $email ) ? $email : '' ?>">
                    </div>
                   
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tel">Мобильный телефон</label>
                        <small style="color: #ff0015;">*</small>
                        <input type="tel" class="form-control" id="tel1"
                               placeholder="Например: 927777777" name="tel1"
                               value="<?php echo isset( $tel1 ) ? $tel1 : '' ?>">
                    </div>
                 <div class="form-group">
                        <label for="start">Дата рождения</label>
                        <small style="color: #ff0015;">*</small>
                        <input type="date" class="form-control" id="birthday" name="birthday"
                          value="<?php echo isset( $birthday ) ? $birthday : '' ?>" >
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary px-5 d-block m-auto" id="registerSubmit">Отправить</button>
        </form>

    </div>
</section>
<br>
<?php get_footer() ?>