<?php
function connect(){
    //Connect to database
    //$connection = new mysqli('localhost', 'wikitshi_agora', 'Cb7+c$J2n9x0', 'wikitshi_agora');
    $connection = new mysqli('localhost', 'root', 'root', 'agora');
    
    //Disconnect if there was a problem.
    if($connection->connect_error){
        die('Failed to connect'.$connection->connect_error);  
    }
    return $connection;
}