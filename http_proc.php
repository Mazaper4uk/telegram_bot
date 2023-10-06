<?php
define("UPDATE", "/getUpdates");
define("MESSAGE", "/sendMessage");

function getUpdates($url,$offset){
$qwery = $url.UPDATE ;
if(!empty ($offset)){
    $qwery = $url.UPDATE."?offset=".$offset;
}
$updates = json_decode(file_get_contents($qwery),true);
return $updates["result"];
}

function sendMsg($url,$chatID,$text){
    $payload = json_encode(array(
        'chat_id' => $chatID,
        'text' => $text
    ));
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json; charset=utf-8',
        'content' => $payload
    )
);
$context  = stream_context_create($opts);
file_get_contents($url.MESSAGE, false, $context); 
}
?>