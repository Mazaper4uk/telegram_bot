<?php

function processMessages($mesages){
$lastUpdateID = "";
$processedMessages = [];
foreach($mesages as $update){
    $lastUpdateID = $update["update_id"];
    $message = $update["message"];
    $chatID = $message["chat"]["id"];
    $fromID = $message["from"]["id"];
    $msgContent = $message["text"];
    array_push($processedMessages,[$chatID,$fromID,$msgContent]);
}
return[$lastUpdateID,$processedMessages];
}

function isRegCmd($cmd){
    if ($cmd=="/reg") {
        return true;
    }
    return false;
}





?>