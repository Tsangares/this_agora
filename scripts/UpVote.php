<?php
include_once('fun.php');
function UpVote($response_id, $user_id){
    $connection = connect();
    if($user_id = -666)$user_id = getIDfromIP();

    //Check to see if vote is already placed.

    //$sql = "SELECT * FROM `response-user` WHERE `response_id` = ".$response_id." AND `user_id` = ".$user_id;
    //Needs to be updated so inner joins with question to stop from voting on all responses.
    $result = $connection->query($sql);
    if($result->num_rows != 0) {
        $connection->close();
        return; 
    }
    $sql = "INSERT INTO `response-user` (``,``) ";
}

if($_POST['response_id']){
    $user_id = -666;
    if($_POST['user_id']){
        $user_id = $_POST['user_id'];
    }
    UpVote($_POST['response_id'], $user_id);
}