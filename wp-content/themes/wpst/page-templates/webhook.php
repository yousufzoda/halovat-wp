<?php 

/* Template Name: webhook Template */

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$mesage_id = $update["callback_query"]["message"]["message_id"];
$id =  $update["callback_query"]["data"];
$text = $update["callback_query"]["message"]["text"].PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL.PHP_EOL;
$text.=  'Принимал заказ : ' .$update["callback_query"]["from"]["username"];
$text = urlencode($text);
global $wpdb;

$wpdb->query($wpdb->prepare("UPDATE wp_drivzakaz SET driver='{$update["callback_query"]["from"]["username"]}' WHERE id={$id}"));

    file_get_contents("https://api.telegram.org/bot869287181:AAF_S2-vgdt51Km38iJyCqreelbDXWTnOno/editMessageText?text={$text}&message_id={$mesage_id}&chat_id=-1001483676653");
    
    
    
    
if($update['message']['chat']['id'] && $update['message']['text']=='getId'){
        file_get_contents("https://api.telegram.org/bot869287181:AAF_S2-vgdt51Km38iJyCqreelbDXWTnOno/sendMessage?chat_id={$update['message']['chat']['id'] }&text={$update['message']['chat']['id'] }");
}