<?php

echo $_POST['email'];

?>
<header class="mb-3">

	<nav class="fixed-top navbar navbar-expand-lg navbar-light bg-white p-0">
		<div class="container">
			<a class="navbar-brand" href="/"><img src="<?= Assets::img( 'logo.png' ) ?>"></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse " id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link " href="#">
                            <span>92 904 50 50 </span></a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#">
                            <ion-icon name="cart"></ion-icon>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="tel:+992929045050">
                            <ion-icon name="call"></ion-icon>
                        </a>
                    </li>
					<?php if ( is_user_logged_in() ): ?>
                        <li class="nav-item" >
                            <a  class="nav-link"  href="https://halovat.tj/my-accaunt">
							<ion-icon name="person"></ion-icon>
                            </a>
                        </li>
                        
                        <li class="nav-item" >
                         <a title="Выход"  class="nav-link" href="http://halovat.tj/wp-login.php?action=logout">
                            <ion-icon name="log-out">Выход</ion-icon>
                        </a>
                        </li>
					<?php else:; ?>
                    <li>
                        <a title="Логин"  class="nav-link " data-toggle="modal" data-target="#exampleModalCenter">
                            <ion-icon name="log-in">Личный кабинет</ion-icon>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="http://halovat.tj/register">
                            <ion-icon name="person-add">Вход</ion-icon>
                        </a>
						<?php endif; ?>
                    </li>
                </ul>

			</div>
		</div>

	</nav>

</header>


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
