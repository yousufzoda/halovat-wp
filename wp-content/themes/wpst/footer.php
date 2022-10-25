
<footer class="section-footer w-100 p-1 mt-3">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-4">
				<h1 class="text-white"><a class="navbar-brand" href="/"><img src="<?= Assets::img( 'logo_white.png' ) ?>"></a></h1>
				
					<ul class="list-group border-0">
				
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="http://halovat.tj/about" class="text-white">О Нас</a></li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="http://halovat.tj/partner" class="text-white">Для ресторанов</a></li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="http://halovat.tj/curier" class="text-white">Стать курьером</a> </li>
				
				</ul>
				
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<ul class="list-group border-0">
					<li class="list-group-item  bg-transparent border-0 text-white"> <h3>Контакты</h3> </li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="#" class="text-white"><ion-icon name="call"></ion-icon>+992(92) 904 50 50</a></li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="#" class="text-white"><ion-icon name="call"></ion-icon>+992(92) 883 77 72</a></li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="#" class="text-white"><ion-icon name="mail"></ion-icon>info@halovat.tj</a> </li>
					
				
				</ul>
			</div>
			<div class="col-12 col-sm-6 col-md-4">
				<ul class="list-group border-0">
					<li class="list-group-item  bg-transparent border-0 text-white"> <h3>Мы в соц.сетях</h3> </li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="https://www.instagram.com/halovat.tj/" class="text-white"><ion-icon name="logo-instagram"></ion-icon>@halovat.tj</a> </li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="https://www.facebook.com/halovat.tj/" class="text-white"><ion-icon name="logo-facebook"></ion-icon>@halovat.tj</a> </li>
					<li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="https://t.me/halovat_tj" class="text-white"><ion-icon name="paper-plane"></ion-icon>@halovat_tj</a> </li>
				    <li class="list-group-item  bg-transparent border-0 p-1 m-0"> <a href="https://wa.me/992929045050" class="text-white"><ion-icon name="logo-whatsapp"></ion-icon>@halovat_tj</a> </li>
				   
				</ul>
			</div>
		</div>
		<div class="text-center text-white">
			<p> Halovat.tj 2020 | Все правы защищены</p>
		</div>
	</div>
</footer>
<?php //wp_footer(); ?>
<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
<script src="<?php echo Assets::js('jquery.min.js') ?> "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?php echo Assets::js('bootstrap.min.js') ?> "></script>
<!--<script src="--><?//= Assets::js('script.js')?><!--"></script>-->
<script src="<?= Assets::js('index.js')?>"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
    console.log();
    if($('#isHidden').data('close')==1){
        localStorage[(new URLSearchParams(location.search)).get('restaurant')]=[];
        $('#ModalZakaz').on('hide.bs.modal', function (e) {
    window.location.href = 'http://halovat.tj';
})
    }
</script>
<?php if($_POST): ?>
<script>
    $(document).ready(function(){
        $('#btn_oformit').trigger('click');
    });
</script>
<?php endif; ?>

</body>
</html>


