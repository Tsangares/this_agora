<?php
include_once('connect.php');
function getIP(){
    $ip = $_SERVER['REMOTE_ADDR'];
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}
function getIDfromIP(){
    $connection = connect();
    $ip = getIP();
    $sql = "SELECT id FROM `users` WHERE `last_ip` = '".$ip."'";
    $result = $connection->query($sql);
    $user_id = '-666';
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $user_id = $row['id'];
        }
    }else{
        $sql = "INSERT INTO `users` (`username`, `last_ip`) VALUES ('Doe', '".$ip."');";
        $connection->query($sql);
        $sql = "SELECT * FROM `users` WHERE `last_ip` = `".$ip."`";
        $result = $connection->query($sql);
        $user_id = $result['id'];
    }
    $connection->close(); 
    return $user_id;
}