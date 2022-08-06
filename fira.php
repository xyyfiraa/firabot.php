<?php

function get($id,$mes){

$token = "5184288176:AAHDgoPTnCeqo6Jgv4H0L5uIeMRNJt2kZ60";

$ch = curl_init();

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);

curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$token/sendMessage?");

$postFields = array(

    'chat_id' => $id,

    'text' => $mes,

    'parse_mode' => 'HTML',

    'disable_web_page_preview' => false,

);

curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

return curl_exec($ch); 

curl_close($ch);

}

$cek = file_get_contents('php://input');

$x = json_decode($cek,1);

$id = $x["message"]["chat"]["id"];

$nama = $x["message"]["chat"]["first_name"];

$text = $x["message"]["text"];

if($text == "/start"){

  $msg = " Selamat Datang $nama \n";

}else{
if(strpos($text,"youtu.be") != null | strpos($text,"youtube.com") != null){

  $link = $text;
   if(file_exists("save.html")){
       unlink("save.html");
       }
  include("file.php");
  $msg = file_get_contents("save.html");
}else{
    // bila tidak url YouTube kita bisa kasih message
    $msg = "maaf url tidak Valid";
}
}

get($id,$msg);

?>
