<?php 
/* Template Name: driver Template */

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

<br>
<div class="container mt-5">
    <div class="row">
    <div class="col-sm-8">
        <form action="" method="post">
  <div class="form-group">
    <label for="res_name">Название ресторана</label>
    <input type="text" class="form-control" id="res_name" placeholder="Введите название ресторана" name="res_name">
  </div>
  <div class="form-group">
    <label for="res_address">Адрес ресторана</label>
    <input type="text" class="form-control" id="res_address" placeholder="Введите адрес ресторана" name="res_address">
  </div>
   <div class="form-group">
    <label for="summa_zakaz">Заказ на сумму</label>
    <input type="text" class="form-control" id="summa_zakaz" placeholder="Введите сумма заказа" name="summa_zakaz">
  </div>
   <div class="form-group">
    <label for="dostavka_narh">Цена доставки</label>
    <input type="text" class="form-control" id="dostavka_narh" placeholder="Введите цена доставки" name="dostavka_narh">
  </div>
  <div class="form-group">
    <label for="client_address">Адрес клиента</label>
    <input type="text" class="form-control" id="client_address" placeholder="Введите адрес клиента" name="client_address">
  </div>
  <div class="form-group">
    <label for="client_tel">Телефон клиента </label>
    <input type="text" class="form-control" id="client_tel" placeholder="Ввведите номер клиента" name="client_tel">
  </div>
  <div class="form-group">
    <label for="zakazchik_tel">Заказ от имени(номер телефон)</label>
    <input type="text" class="form-control" id="zakazchik_tel" placeholder="Ввведите свой номер" name="zakazchik_tel">
  </div>
   <div class="form-group">
    <label for="comment">Комментария</label>
    <textarea type="text" class="form-control" id="comment" placeholder="" name="comment"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Отправить заказ</button>
</form>
    </div>
</div>

</div>


<?php 

if($_POST){
    $text = 'Привет!%0A';
    $text.= 'Название ресторана : ' . $_POST['res_name'].'%0A';
    $text.= 'Адрес ресторана : ' . $_POST['res_address'].'%0A';
    $text.= 'Заказ на сумму : ' . $_POST['summa_zakaz'].'smn%0A';
    $text.= 'Цена за доставки : ' . $_POST['dostavka_narh'].'smn';
    $text.= 'Адрес клиента : ' . $_POST['client_address'].'%0A';
    $text.= 'Телефон клиента : ' . $_POST['client_tel'].'%0A';
    $text.= 'Сделано заказ от : ' . $_POST['zakazchik_tel'].'%0A';
    $text.= 'Комментария : ' . $_POST['comment'].'%0A';
    
    


 global $wpdb;
    $wpdb->insert("wp_drivzakaz", array(
       "name_rest" => $_POST['res_name'],
       "address_rest" => $_POST['res_address'],
       "summa_zakaz" => $_POST['summa_zakaz'],
       "dostavka_narh" => $_POST['dostavka_narh'],
       "address_client" => $_POST['client_address'],
       "tel_client" => $_POST['client_tel'],
       "zakazchik" => $_POST['zakazchik_tel'] ,
       "comment" => $_POST['comment'],
       "driver" => '',
    ));
    $id = $wpdb->insert_id;
    
   $keyboard = ['inline_keyboard' => [ [ ['text' => 'Принять заказ', 'callback_data' => $id] ] ] ];

$encodedKeyboard = json_encode($keyboard);

file_get_contents("https://api.telegram.org/bot869287181:AAF_S2-vgdt51Km38iJyCqreelbDXWTnOno/sendMessage?chat_id=-1001483676653&text={$text}&reply_markup={$encodedKeyboard}");
}
   





?>

<?php get_footer() ?>