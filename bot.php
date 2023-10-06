<?php
include 'core/config.php';
include 'core/http_proc.php';
include 'core/message.php';

[$interval,$url,$users,$dbconn] = laoad_conf();
$updateID = ""; 
echo "Bot started intervar ".$interval."\n";

while(true){
$update = getUpdates($url,$updateID);
[$lastupdate,$messages] = processMessages($update);
if(is_numeric($lastupdate)){
    $updateID = $lastupdate + 1;
}
foreach($messages as $message) {
    $chatID = $message[0];
    $senderID = $message[1];
    $text = $message[2];

if(reg_Users($users,$senderID)){
    sendMsg($url,$chatID,$text);
}

else {
    if (!isRegCmd($text)) {
        sendMsg($url,$chatID,"===***Вы не зарегестрированны***===");
    } else {
        pg_query($dbconn, "INSERT INTO users (p_user) VALUES ('$senderID')");
        sendMsg($url,$chatID,"***Добро пожаловать***");
        array_push($users,$senderID);
    }
}
}
sleep($interval);
}

?>