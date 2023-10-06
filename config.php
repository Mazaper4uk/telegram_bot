<?php
define("CONFIG","conf/config_bot.json");
function laoad_conf(){
$config_json = json_decode(file_get_contents(CONFIG),true);    
$host = $config_json["host"];
$port = $config_json["port"];
$dbname = $config_json["dbname"];
$user = $config_json["user"];
$password = $config_json["password"];
$dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

$sql_conf ='SELECT ulr_api, token, interval FROM config';
$sql_user = 'SELECT p_user FROM users';
$result_conf = pg_query($dbconn,$sql_conf);
$result_user = pg_query($dbconn,$sql_user);
$result_conf = pg_fetch_array($result_conf, null, PGSQL_ASSOC);
$result_user = pg_fetch_all($result_user, PGSQL_ASSOC);
$url = $result_conf["ulr_api"];
$token = $result_conf["token"];
$interval = $result_conf["interval"];
return[$interval,$url.$token,$result_user,$dbconn];
}

function reg_Users($user,$senderID){
    if(empty($user)){
        return true;
    }
    foreach($user as $vr){
        if($senderID == $vr){
        return true;  
        }
    }
    echo("[WARNING] Got request from not authorized user with id=".$senderID."\n");
    return false;
}

?>